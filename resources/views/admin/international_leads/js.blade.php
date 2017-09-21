<script type="text/javascript">
    $(document).ready(function ()
    {
        commentSection();
    });
    function commentSection()
    {
        var count = 0;
        dyn = $("#dynamic-div");
        var parentClass = 'commentContainer';
        var removeBtnClass = 'removeBtn';
        var hiddenClass = 'hidden';
        var addMoreBtnClass = 'addComment';
        btnToggle();

        dyn.on('click', '.'+removeBtnClass, function ()
        {
            if ( $("."+parentClass).length > 1 )
            {
                $(this).parent('div').parent('div').remove();
                btnToggle(parentClass);
//                console.log($(".commentContainer").length);
            } else
            {
                $("."+removeBtnClass).removeClass(hiddenClass);
                btnToggle(parentClass);
//                alert("comp");

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

        dyn.on('click', '.'+addMoreBtnClass , function ()
        {
            addField();


            btnToggle(parentClass);
        });

        function addField()
        {
            dyn = $("#dynamic-div");
            count++;
//            var content = '<div class="col-md-12 commentContainer"><div class="col-md-8"><textarea placeholder="Enter Comment" name="lead_comment[]" id="lead_comment_' + count + '" cols="30" rows="10" class="form-control"></textarea></div><div class="col-md-4"><input class="btn btn-danger removeBtn" type="button" value="Remove"></div></div>';
            var content = '<div class="col-md-12 '+parentClass+'"><div class="col-md-8"><textarea placeholder="Enter Comment" name="lead_comment[]" id="lead_comment_' + count + '" cols="30" rows="10" class="form-control"></textarea></div><div class="col-md-4"><input class="btn btn-danger removeBtn" type="button" value="Remove"></div></div>';
            dyn.append(content);
        }
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
