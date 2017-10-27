<script type="text/javascript">

    //    var datePickerOptions = {minDate: new Date() , toolbarPlacement: "bottom", format: "d/m/Y hh:mm t" }; //, format: "dd/m/Y hh:mm t"
    var datePickerOptions = {format: "D-MMM-Y hh:mm A" , toolbarPlacement: "bottom"}; //, format: "dd/m/Y hh:mm t"
    var divCount          = '{{ (isset( $count ))?$count:1 }}';
    var remCount          = '{{ (isset( $reminderCount ))?$reminderCount:1 }}';


    $(document).ready(function ()
    {

//        alert("abc");
        commentSection(divCount);
        saveNote();
        reminderSection(remCount);
        saveReminder();
        $('.remindDateTime').datetimepicker(datePickerOptions);
    });


    function commentSection( cnt )
    {
        var count    = cnt;
        var duration = 500;

        dyn                 = $("#dynamic-div");
        var parentClass     = 'notesContainer';
        var removeBtnClass  = 'removeBtn';
        var hiddenClass     = 'hidden';
        var addMoreBtnClass = 'addNote';
        btnToggle(parentClass);

        dyn.on('click' , '.' + removeBtnClass , function ( e )
        {
            var that           = $(this);
            var lid            = $("#lead_id").val();
            var count          = that.data('id');
            var noteidSelector = '#note_id_' + count;
            var notesDiv       = '#notes_' + count;
            var note_val       = $(noteidSelector).val();
            var token          = $('input[name="_token"]').val();
            var parent         = $(notesDiv);
            var len            = $('.' + parentClass).length;
            if ( note_val != '' )
            {
                var requestType = 'DELETE';
                var URLString   = '{{ route('international.ajaxDelete') }}';
                var dataString  = {_token: token , note_id: note_val , lead_id: lid};
                if ( confirm("Are you sure you want to delete this note?") )
                {
                    ajax(requestType , URLString , dataString);


                    $(parent).slideUp(duration , function ()
                    {
                        parent.remove();
                        btnToggle(parentClass);
                    });
                } else
                {
                    $("#lead_note_" + count).focus();
                }
            } else
            {
                $(parent).slideUp(duration , function ()
                {
                    parent.remove();
                    btnToggle(parentClass);
                });
            }


        });

        function btnToggle( parentClassName )
        {
            var len   = $('.' + parentClassName).length;
            removeBtn = $('.' + removeBtnClass);

            if ( len == 0 )
            {
                addField();
            }
//            console.log("len = "+$('.' + parentClassName).length);
        }

        dyn.on('click' , '.' + addMoreBtnClass , function ()
        {
            addField();
            btnToggle(parentClass);
        });

        function addField()
        {
            dyn = $("#dynamic-div");
            count++;
//            var content = '<div class="col-md-12 commentContainer"><div class="col-md-8"><textarea placeholder="Enter Comment" name="lead_comment[]" id="lead_comment_' + count + '" cols="30" rows="10" class="form-control"></textarea></div><div class="col-md-4"><input class="btn btn-danger removeBtn" type="button" value="Remove"></div></div>';
            var content = '<div id="notes_' + count + '" class="col-md-12 ' + parentClass + '"><input type="hidden" id="note_id_' + count + '" name="note_id_' + count + '" value="" ><div class="note-bg"><textarea placeholder="Enter notes" name="lead_note_' + count + '" id="lead_note_' + count + '" rows="3" data-id = "' + count + '" class="form-control notes-area txtArea"></textarea><div  class="btn-col"><button type="button" name="save" data-id = "' + count + '" class="btn btn-success saveBtn">Save</button><button class="btn btn-danger removeBtn" data-id = "' + count + '" type="button" value="remove">Remove</button></div></div></div>';
//                dyn.append(content);
//            $(".addNote").after(function ()
//            {
//                return content;
//            });
            var addNoteBtn = $(".addNote").parent('div');

            addNoteBtn.before(function ()
            {
                return content;
            });
            $("#note_id_" + count).parent('div').hide().slideDown(duration);
        }


    }

    function saveNote()
    {
        dyn = $("#dynamic-div");
//        dyn.on('click' , '.saveBtn' , function ()
//        $(document).on('blur' , '.notes-area' , function ()

        dyn.on('click' , '.saveBtn' , function ()
        {
//            alert("hi");
            var that             = $(this);
            var lid              = $("#lead_id").val();
            var count            = that.data('id');
            var textareaSelector = '#lead_note_' + count;
            var noteidSelector   = '#note_id_' + count;
            var note_val         = $(noteidSelector).val();
            var textarea_val     = $.trim($(textareaSelector).val());
            var token            = $('input[name="_token"]').val();

            if ( textarea_val.length > 0 && textarea_val !== undefined )
            {
                var requestType = '' , URLString = '';
                var dataString  = {_token: token , lead_id: lid , lead_note: textarea_val};
                if ( note_val != '' )
                { //update note
                    requestType        = 'PUT';
                    dataString.note_id = note_val;
                    URLString          = '{{ route('international.ajaxUpdate') }}';
                }
                else
                { //insert note
                    URLString   = '{{ route('international.ajaxInsert') }}';
                    requestType = 'POST';
                }
                ajax(requestType , URLString , dataString , noteidSelector);
            }
//            else {
//                alert("Please enter some text");
//            }
        });
    }

    function ajax( requestType , URLString , dataString , noteidSelector )
    {
        $.ajax({
            type: requestType ,
            data: dataString ,
            url: URLString ,
            async: false ,
            success: function ( response )
            { // change hidden value of 'note_id' if insert operation is performed

                if ( requestType == 'PUT' )
                {//update note
                    alert(response.msg);
                } else if ( requestType == 'POST' )
                { // insert note
                    $(noteidSelector).val(response.note_id);
                    alert(response.msg);
                } else if ( requestType == 'DELETE' )
                {
                    alert(response.msg);
                } else
                {
                    alert("something else");
                }
            } ,
            error: function ( error )
            {
                alert("error");
                console.error(error);
            }
        });
    }

    $("#international_lead_form").validate(
        {
            rules:
                {
                    project_name: {
                        required: true ,
                        maxlength: 300
                    } ,
                    source: {
                        required: true
                    } ,
                    currency: {
                        required: {
                            depends: function ()
                            {
                                if ( $("#amount").val() == '' )
                                    return false;
                                else
                                    return true;
                            }
                        }
                    } ,
                    amount: {
                        required: {
                            depends: function ()
                            {
                                if ( $("#currency").val() == '' )
                                    return false;
                                else
                                    return true;
                            }
                        } ,
                        number: true ,
                        min: 0.01
                    } ,
                    url: {
                        required: true ,
                        url: true
                    } ,
                    email: {
                        email: true
                    }
                } ,
            submitHandler: function ( form )
            {
//            console.log(form.serializeArray());
//            return false;
                $("#submit").attr('disabled' , true);
                form.submit();
            }
        });

    function reminderSection( reminderCount )
    {
        var remCount       = reminderCount;
        var remDyn         = $("#reminder-dynamic-div");
        var addBtnClass    = 'addReminder';
        var removeBtnClass = 'removeReminder';
        var parentClass    = 'reminderContainer';
//        console.log('leng'+ $('.'+parentClass).length);
        var duration       = 500;

        function addReminderField()
        {
//            var remDyn = $("#reminder-dynamic-div");
            remCount++;
//            var content = '<div id="reminder_' + remCount + '" class="col-md-12 ' + parentClass + '"><div class="note-bg"><input type="hidden" id="reminder_id_' + remCount + '" name="reminder_id_' + remCount + '" value="" ><textarea placeholder="Enter reminder subject" name="reminder_note_' + remCount + '" id="reminder_note_' + remCount + '" rows="3" data-id = "' + remCount + '" class="form-control notes-area txtArea"></textarea><div  class="btn-col"><button type="button" name="save" data-id = "' + remCount + '" class="btn btn-success saveBtn">Save</button><button class="btn btn-danger ' + removeBtnClass + '" data-id = "' + remCount + '" type="button" value="remove">Remove</button></div></div></div>';
            var content = '<div id="reminder_' + remCount + '" class="col-md-12 ' + parentClass + '"><div class="note-bg"><div class="row form-group" style="margin-bottom: 10px;"><div class="col-md-12 crm-group"><label for="time" class="control-label crm-label">Time: </label><input id="remind_time_' + remCount + '" type="text" value="" class="remindDateTime form-control crm-control"></div></div><input type="hidden" id="reminder_id_' + remCount + '" name="reminder_id_' + remCount + '" value="" ><textarea placeholder="Enter reminder subject" name="subject_' + remCount + '" id="reminder_note_' + remCount + '" rows="3" data-id = "' + remCount + '" class="form-control notes-area txtArea"></textarea><div  class="btn-col"><button type="button" name="save" data-id = "' + remCount + '" class="btn btn-success saveReminderBtn">Save</button><button class="btn btn-danger ' + removeBtnClass + '" data-id = "' + remCount + '" type="button" value="remove">Remove</button></div></div></div>';

            var addReminderBtn = $("." + addBtnClass).parent('div');

            addReminderBtn.before(function ()
            {
                return content;
            });
            $('.remindDateTime').datepicker('remove').datetimepicker(datePickerOptions);
            $("#reminder_id_" + remCount).parent('div').hide().slideDown(duration);
        }

        function btnReminderToggle( parentClassName )
        {
            var len   = $('.' + parentClassName).length;
            removeBtn = $('.' + removeBtnClass);

            if ( len == 0 )
            {
                addReminderField();
            }
//            console.log("len = "+$('.' + parentClassName).length);
        }

        remDyn.on('click' , '.' + addBtnClass , function ()
        {
            addReminderField();
            btnReminderToggle(parentClass);
        });

        remDyn.on('click' , '.' + removeBtnClass , function ( e )
        {

            var that             = $(this);
            var lid              = $("#lead_id").val();
            var count            = that.data('id');
            var remindidSelector = '#reminder_id_' + count;
            var notesDiv         = '#reminder_' + count;
            var reminderID_val   = $(remindidSelector).val();
            var token            = $('input[name="_token"]').val();
            var parent           = $(notesDiv);
            var len              = $('.' + parentClass).length;
 
        
            if ( reminderID_val != '' )
            {
                var requestType = 'DELETE';
                var URLString   = '{{ route('international.ajaxReminderDelete') }}';
                var dataString  = {_token: token , reminder_id: reminderID_val , lead_id: lid};
//                console.log("Request: "+requestType);
//                console.log("URL String: "+URLString);
//                console.log("data String: "+dataString);
//                console.log("remindidSelector: "+remindidSelector);
//                console.log(JSON.stringify(dataString));
                if ( confirm("Are you sure you want to delete this reminder?") )
                {
                    ajaxReminder(requestType , URLString , dataString);

                    var duration = 500;
                    console.error(parentClass);
                    $(parent).slideUp(duration , function ()
                    {
                        parent.remove();
                        btnReminderToggle(parentClass);
                    });
                } else
                {
                    $("#reminder_note_" + count).focus();
                }
            } else
            {
                $(parent).slideUp(duration , function ()
                {
                    parent.remove();
                    btnReminderToggle(parentClass);
                });
            }


        });

    }

    function saveReminder()
    {
        var saveBtnClass = 'saveReminderBtn';
        var remDyn       = $("#reminder-dynamic-div");
//        dyn.on('click' , '.saveBtn' , function ()
//        $(document).on('blur' , '.notes-area' , function ()

        remDyn.on('click' , '.' + saveBtnClass , function ()
        {
            var that             = $(this);
            var lid              = $("#lead_id").val();
            var count            = that.data('id');
            var textareaSelector = '#reminder_note_' + count;
            var timeSelector     = '#remind_time_' + count;
            var remindidSelector = '#reminder_id_' + count;
            var note_val         = $(remindidSelector).val();
            var time_val         = $(timeSelector).val();
            var textarea_val     = $.trim($(textareaSelector).val());
            var token            = $('input[name="_token"]').val();

            if ( textarea_val.length > 0 && textarea_val !== undefined )
            {
                var requestType = '' , URLString = '';
                var dataString  = {
                    _token: token ,
                    lead_id: lid ,
                    reminder_note: textarea_val ,
                    reminder_time: time_val
                };
//                console.log(dataString);
                if ( note_val != '' )
                { //update note
                    requestType            = 'PUT';
                    dataString.reminder_id = note_val;
                    URLString              = '{{ route('international.ajaxReminderUpdate') }}';
                }
                else
                { //insert note
                    URLString   = '{{ route('international.ajaxReminderInsert') }}';
                    requestType = 'POST';
                }
//
//                console.log("Request: "+requestType);
//                console.log("URL String: "+URLString);
//                console.log("data String: "+dataString);
//                console.log("remindidSelector: "+remindidSelector);
//                return false;
                ajaxReminder(requestType , URLString , dataString , remindidSelector);
            }
            else
            {
                alert("Please enter some text");
            }
        });
    }

    function ajaxReminder( requestType , URLString , dataString , remindidSelector )
    {
        $.ajax({
            type: requestType ,
            url: URLString ,
            data: dataString ,
            async: false ,
            success: function ( response )
            { // change hidden value of 'note_id' if insert operation is performed

                if ( requestType == 'PUT' )
                {//update note
                    alert(response.msg);
                } else if ( requestType == 'POST' )
                { // insert note
                    $(remindidSelector).val(response.reminder_id);
                    alert(response.msg);
                } else if ( requestType == 'DELETE' )
                {
                    alert(response.msg);
                } else
                {
                    alert("something else");
                }
            } ,
            error: function ( error )
            {
                alert("error");
                console.error(error);
            }
        });
    }

</script>
