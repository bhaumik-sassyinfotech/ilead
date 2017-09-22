<script type="text/javascript">

    $(document).ready(function ()
    {
        commentSection(divCount);
        saveNote()
    });
        function commentSection( cnt )
        {
            var count = cnt;
            dyn = $("#dynamic-div");
            var parentClass = 'notesContainer';
            var removeBtnClass = 'removeBtn';
            var hiddenClass = 'hidden';
            var addMoreBtnClass = 'addNote';
            var lead_id = '{{ $leadData->lead_id }}';
            btnToggle();

            dyn.on('click', '.' + removeBtnClass, function ()
            {
                if ( $("." + parentClass).length > 1 )
                { //hide remove button
//                console.log($(".commentContainer").length);
                    $(this).parent('div').parent('div').remove();
                    btnToggle(parentClass);
                } else
                { // show remove button
                    $("." + removeBtnClass).removeClass(hiddenClass);
                    btnToggle(parentClass);
                }
            });
            function btnToggle( parentClassName )
            {
                var len = $('.' + parentClassName).length;


//            console.log("len = "+len);
                removeBtn = $("." + removeBtnClass);

                if ( len >= 2 )
                {
                    removeBtn.removeClass(hiddenClass);

                } else
                {
                    removeBtn.addClass(hiddenClass);
                }
            }

            dyn.on('click', '.' + addMoreBtnClass, function ()
            {
                addField();


                btnToggle(parentClass);
            });

            function addField()
            {
                dyn = $("#dynamic-div");
                count++;
//            var content = '<div class="col-md-12 commentContainer"><div class="col-md-8"><textarea placeholder="Enter Comment" name="lead_comment[]" id="lead_comment_' + count + '" cols="30" rows="10" class="form-control"></textarea></div><div class="col-md-4"><input class="btn btn-danger removeBtn" type="button" value="Remove"></div></div>';
                var content = '<div class="col-md-12 ' + parentClass + '"><input type="hidden" id="note_id_' + count + '" name="note_id_' + count + '" value="" ><div class="col-md-6"><textarea placeholder="Enter notes" name="lead_note_' + count + '" id="lead_note_' + count + '" cols="30" rows="10" class="form-control"></textarea></div><div class="col-md-3"><button type="button" name="save" data-id = "' + count + '" class="btn btn-success saveBtn">Save</button></div><div class="col-md-3"><button class="btn btn-danger removeBtn" data-id = "' + count + '" type="button" value="remove">Remove</button></div></div>';
                dyn.append(content);
            }
        }

        function saveNote()
        {
            dyn = $("#dynamic-div");
            dyn.on('click', '.saveBtn', function ()
            {
                var that = $(this);
                var lid = $("#lead_id").val();
                var count = that.data('id');
                var textareaSelector = '#lead_note_' + count;
                var noteidSelector = '#note_id_' + count;
                var note_val = $(noteidSelector).val();
                var textarea_val = $(textareaSelector).val();
                var token = $('input[name="_token"]').val();

                if ( textarea_val != '' )
                {
                    var requestType = '' , URLString = '';
                    var dataString = { _token : token , lead_id : lid , lead_note : textarea_val };
                    if( note_val != '' )
                    { //update note
                        requestType = 'PUT';
                        URLString = '{{ route('international.ajaxUpdate') }}';
                    }
                    else
                    { //insert note
                        URLString = '{{ route('international.ajaxInsert') }}';
                        requestType = 'POST';
                    }

                    ajax(requestType , URLString , dataString);
                } else
                {
                    alert("Please enter some text.")
                }
            })
        }

        function ajax( requestType , URLString , dataString )
        {
            $.ajax({
                type: requestType,
                data: dataString,
                url:  URLString,
                success: function (response)
                {
                    alert("success");
                }
            });
        }

        $("#international_lead_form").validate({
            rules: {
                project_name: {
                    required: true,
                    maxlength: 300
                },
                currency: {
                    required: true,
                },
                amount: {
                    required: true,
                    number: true,
                    min: 0.01
                },
                url: {
                    required: true,
                    url: true
                },
                email: {
                    email: true,
                }
            },
            submitHandler: function ( form )
            {

                $("#submit").attr('disabled', true);
                form.submit();
            }
        });
</script>
