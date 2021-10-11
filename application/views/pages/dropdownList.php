<form action="dropdown/setModuleData" method="post">

    <table class="table table-borderless" id="cloneThisCt">

        <?php

        $i = 0;

        foreach ($data as $dataskey => $dataValue) {

            $i++;

        ?>

            <tr>

                <th>

                    <input type="text" class="form-control m-input"  name="check[]" value="<?php echo $dataValue['name']; ?>">

                    <input type="hidden" name="moduleId[]" value="<?php echo $dataValue['id']; ?>">

                </th>

                <th><span style="color: red;cursor: pointer;" onclick="deleteField(<?php echo $dataValue['id'] . "," . "'$module'" ?>)"> <i class="la la-trash"></i></span></th>

            </tr>

        <?php } ?>
        <!-- <tr id="cloneThisCt"> </tr> -->
        <tr>

            <td colspan="4">

            </td>

        </tr>

    </table>
    <div class="col-lg-6 col-md-6">
    <input type="hidden" name="module_name" value="<?php echo $module ?>">
                <input type="hidden" name="i_value" id= value="<?php echo $dataValue['id']; ?>">


                <span class="input-group-btn">

                <button type="button" id="usrContactAdd" class="btn-sm btn m-btn--icon btn-success btn-add">

                        <span> <i class="la la-plus"></i> <span>Add</span> </span>

                    </button>

                </span>

                <input type="submit" class="btn btn-success">
    </div>
</form>