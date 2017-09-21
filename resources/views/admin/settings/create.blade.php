@extends('admin.layouts.app')
@section('content')

@if(session()->has('success'))       
<div class="alert alert-success">
    {{ session()->get('success') }}   
</div>
@endif
@if(session()->has('err_msg'))  
<div class="alert alert-danger">
    {{ session()->get('err_msg') }}  
</div>
@endif
<div>

    <div class="col-md-6 nopadding"><h3 class="page-title">Settings</h3></div>

    <div class="col-md-6 pull-right nopadding"><p style="float:right;"><a href="{{ url('/admin/dashboard') }}">Dashboard</a> > <a href="{{ route('readSettingData') }}">Settings </a> > Settings</p></div>

</div>



<form method="POST" action="{{ route('settings.store') }}">

    <div class="new_button">

       <div class="pull-right extra_button">

            <input type="submit" name="createSettings" class="btn btn-danger" value="Save">

        </div>

        <div class="pull-right extra_button">

            <a href="{{ route('settings.index') }}" class="btn btn-success extra_button" >Back</a>

        </div>

        <div style="clear: both;"></div>

    </div>



    <div class="panel panel-default">

        <div class="panel-heading">

            Settings

        </div>



        <div class="panel-body ">



         

            <div class="col-md-3">



                <ul class="page-sidebar-menu vertical-menu"

                    data-keep-expanded="false"

                    data-auto-scroll="true"

                    data-slide-speed="200">

                        <?php foreach ($xml as $tab) { ?>

                        <li class="">                   

                            <span style="cursor: pointer" class="title tab_title" id="<?= $tab->attributes()->id; ?>" ><?= $tab->attributes()->label; ?></span>

                        </li>





                        <?php

                    }

                    ?>

                </ul>

            </div>

            <div class="col-md-9 ">
           
                <?php

                foreach ($xml as $tab) {

                    ?>

                    <div class=" tab tab_for_<?= $tab->attributes()->id; ?>" >
                    <div class="container_tab_title">
                        <span ><?= $tab->attributes()->label; ?></span>
                      </div>  
                               {{ csrf_field() }}

                        <?php

                        foreach ($tab as $section) {

                            ?>

                            <div class="box section" >
                                    <div class="section_title">
                                <h2 class="" id="<?= $tab->section->attributes()->id; ?>"><?= $tab->section->attributes()->label; ?></h2>

                                </div>

                                <?php

                                foreach ($section->field as $field) {

                                    if ($field->type == 'text') {

                                        ?>



                                        <div class="row">

                                            <div class="col-xs-12 col-md-12 col-sm-12 form-group">

                                                <label class="control-label" for="<?= $tab->attributes()->id . '_' . $section->attributes()->id . '_' . $field->attributes()->id; ?>" ><?= $field->attributes()->label; ?></label>

                                                <input  type="<?= $field->type; ?>" 

                                                        id="<?= $tab->attributes()->id . '_' . $section->attributes()->id . '_' . $field->attributes()->id; ?>" 

                                                        name="<?= $tab->attributes()->id . '[' . $section->attributes()->id . '][' . $field->attributes()->id . ']'; ?>" 

                                                        class="<?= $tab->attributes()->id . '_' . $section->attributes()->id . '_' . $field->attributes()->id; ?> form-control" 

                                                        value="<?= Helpers::getAdminSetting($tab->attributes()->id . '+++' . $section->attributes()->id . '+++' . $field->attributes()->id) ?>"

                                                        required=" <?= $field->required; ?>">

                                                <p class="note"><?= $field->note; ?></p>

                                            </div>

                                        </div>

                                        <?php

                                    }

                                    if ($field->type == 'select') {

                                        // echo "<pre>";

                                        //print_r($field->options);

                                        ?>

                                        <div class="row">

                                            <div class="col-xs-12 col-md-12 col-sm-12 form-group">

                                                <label class="control-label" for="<?= $tab->attributes()->id . '_' . $section->attributes()->id . '_' . $field->attributes()->id; ?>" ><?= $field->attributes()->label; ?></label>

                                                <select id="<?= $tab->attributes()->id . '_' . $section->attributes()->id . '_' . $field->attributes()->id; ?>"

                                                        name="<?= $tab->attributes()->id . '[' . $section->attributes()->id . '][' . $field->attributes()->id . ']'; ?>" 

                                                        class="<?= $tab->attributes()->id . '_' . $section->attributes()->id . '_' . $field->attributes()->id; ?> form-control"

                                                        value="<?= Helpers::getAdminSetting($tab->attributes()->id . '+++' . $section->attributes()->id . '+++' . $field->attributes()->id) ?>"

                                                        required=" <?= $field->required; ?>">

                                                    <?php foreach ($field->options->option as $select_option) { ?>

                                                        <option value="<?= $select_option->attributes()->value; ?>"><?= $select_option->attributes()->label; ?></option>

                                                    <?php } ?>

                                                </select>

                                                <p class="note"><?= $field->note; ?></p>

                                            </div>

                                        </div>

                                        <?php

                                    }

                                    if ($field->type == 'radio') {

                                        ?>

                                        <div class="row">

                                            <div class="col-xs-12 col-md-12 col-sm-12 form-group">

                                                <label class="control-label" for="<?= $tab->attributes()->id . '_' . $section->attributes()->id . '_' . $field->attributes()->id; ?>" ><?= $field->attributes()->label; ?></label>

                                                <?php foreach ($field->options->option as $radio_option) { ?>                                            

                                                    <?= $radio_option->attributes()->label; ?>: <input 

                                                        type="<?= $field->type ?>" 

      name="<?= $tab->attributes()->id . '[' . $section->attributes()->id . '][' . $field->attributes()->id . ']'; ?>" 

                                                             value="<?= $radio_option->attributes()->value; ?>" 

                                            <?php if($radio_option->attributes()->value == Helpers::getAdminSetting($tab->attributes()->id . '+++' . $section->attributes()->id . '+++' . $field->attributes()->id)){echo "checked";} ?>

                                                             

                                     class="<?= $tab->attributes()->id . '_' . $section->attributes()->id . '_' . $field->attributes()->id; ?> 

                                                   " />

                                                <?php } ?>

                                               

                                            </div>

                                        </div>

                                        <?php

                                    }

                                    if ($field->type == 'checkbox') {

                                        ?>

                                        <div class="row">

                                            <div class="col-xs-12 col-md-12 col-sm-12 form-group">

                                                <label class="control-label" for="<?= $tab->attributes()->id . '_' . $section->attributes()->id . '_' . $field->attributes()->id; ?>" ><?= $field->attributes()->label; ?></label>

                                                <?php foreach ($field->options->option as $checkbox_option) { ?>                                            

                                                    <input 

                                                        type="<?= $field->type ?>" 

                                                        name="<?= $tab->attributes()->id . '[' . $section->attributes()->id . '][' . $field->attributes()->id . '][]'; ?>"

                                                        <?php if($checkbox_option->attributes()->value == Helpers::getAdminSetting($tab->attributes()->id . '+++' . $section->attributes()->id . '+++' . $field->attributes()->id)){echo "checked";} ?>

                                                        value="<?= $checkbox_option->attributes()->value; ?>"><?= $checkbox_option->attributes()->label; ?>&nbsp;    

                                                <?php } ?>

                                                <p class="note"><?= $field->note; ?></p>

                                            </div>

                                        </div>

                                        <?php

                                    }

                                    if ($field->type == 'file') {

                                        ?>

                                        <div class="row">

                                            <div class="col-xs-12 col-md-12 col-sm-12 form-group">

                                                <label class="control-label" for="<?= $tab->attributes()->id . '_' . $section->attributes()->id . '_' . $field->attributes()->id; ?>" ><?= $field->attributes()->label; ?></label>

                                                <input type="<?= $field->type ?>" 

                                                       id="<?= $tab->attributes()->id . '_' . $section->attributes()->id . '_' . $field->attributes()->id; ?>" name="<?= $tab->attributes()->id . '[' . $section->attributes()->id . '][' . $field->attributes()->id . ']'; ?>" value="" 

                                                       required="<?= $field->required; ?>">

                                                <p class="note"><?= $field->note; ?></p>

                                            </div>

                                        </div>

                                        <?php

                                    }

                                    if ($field->type == 'textarea') {

                                        ?>

                                        <div class="row">

                                            <div class="col-xs-12 form-group">

                                                <label for="status"><?= $field->attributes()->label; ?> </label>

                                                <textarea id="content" 

                                                          name="<?= $tab->attributes()->id . '[' . $section->attributes()->id . '][' . $field->attributes()->id . ']'; ?>"  

                                                          class="<?= $tab->attributes()->id . '_' . $section->attributes()->id . '_' . $field->attributes()->id; ?> 

                                                          form-control"><?= Helpers::getAdminSetting($tab->attributes()->id . '+++' . $section->attributes()->id . '+++' . $field->attributes()->id) ?></textarea>
														  
														 <p class="note "><?= $field->note; ?></p>
														
                                            </div>
                                        </div>

                                        <?php

                                    }

                                }

                                ?>

                            </div>

                            <?php

                        }

                        ?>

                       

                       

                    </div>



                    <?php

                }

                ?>

            </div>





        </div>

    </div>

    <input type="hidden" id="active_tab" name="active_tab"  />

</form>


@endsection

@section('javascript')

<script type="text/javascript">

    $(document).ready(function () {

        $(".tab_title").click(function () {

            //  e.preventDefault();

            window.myId = $(this).attr("id");

            $(".tab").hide('fast', function () {

                $(".tab.tab_for_" + window.myId).show('fast');

            });

            $(".tab_title").removeClass('active', function () {

                $(".tab_title#" + window.myId).addClass('active');

            });

            $("#active_tab").val(window.myId);

        });



        //code for tab event ends



        var pageUrl = window.location.href.split('#');



        if (pageUrl.length > 1)

        {

            var my_active_tab = $("#active_tab").val();

            alert(my_active_tab);

            $(".tab").hide('fast', function () {

                $(".tab.tab_for_" + my_active_tab).show('fast');

            });

            $(".tab_title").removeClass('active', function () {

                $(".tab_title#" + my_active_tab).addClass('active');

            });

            return;

        }

        $(".tab").hide('fast', function () {

            $(".tab").first().show();

            $(".tab_title").first().addClass('active');

            $("#active_tab").val($(".tab_title").first().attr("id"));

        });

    });

</script>

@endsection