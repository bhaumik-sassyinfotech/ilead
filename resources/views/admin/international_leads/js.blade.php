<script type="text/javascript">

   
    var divCount = '{{ (isset( $count ))?$count:1 }}';

    $(document).ready(function ()
    {

//        alert("abc");
        commentSection(divCount);
        saveNote();

    });


    function commentSection( cnt )
    {
        var count           = cnt;
        var duration        = 500;
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
            var note_val       = $(noteidSelector).val();
            var token          = $('input[name="_token"]').val();

            var len = $('.' + parentClass).length;
            if ( note_val != '' )
            {
                var requestType = 'DELETE';
                var URLString   = '{{ route('international.ajaxDelete') }}';
                var dataString  = {_token: token , note_id: note_val , lead_id: lid};
                ajax(requestType , URLString , dataString);
            }
            var parent = $(that).parent('div').parent('div');
            $(parent).slideUp(duration , function ()
            {
                parent.remove();
                btnToggle(parentClass);
            });


        });

        function btnToggle( parentClassName )
        {
            var len   = $('.' + parentClassName).length;
            removeBtn = $("." + removeBtnClass);

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
            var content = '<div class="col-md-12 ' + parentClass + '"><input type="hidden" id="note_id_' + count + '" name="note_id_' + count + '" value="" ><div class="col-md-6"><textarea placeholder="Enter notes" name="lead_note_' + count + '" id="lead_note_' + count + '" rows="3" class="form-control txtArea"></textarea></div><div class="col-md-3"><button type="button" name="save" data-id = "' + count + '" class="btn btn-success saveBtn">Save</button></div><div class="col-md-3"><button class="btn btn-danger removeBtn" data-id = "' + count + '" type="button" value="remove">Remove</button></div></div>';
//                dyn.append(content);
            $(".addNote").after(function ()
            {
                return content;
            });
            $("#note_id_" + count).parent('div').hide().slideDown(duration);
        }
    }

    function saveNote()
    {
        dyn = $("#dynamic-div");
        dyn.on('click' , '.saveBtn' , function ()
        {
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
            } else
            {
                alert("Please enter some text.")
            }
        })
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
                    currency: {
                        required: true
                    } ,
                    amount: {
                        required: true ,
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
</script>
