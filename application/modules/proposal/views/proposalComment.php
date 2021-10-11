<table class="table table-bordered">

    <thead>

        <tr style="height: 32px;color: black;background-color: #d1cdcd;font-size: 15px">

            <th>Sr No</th>

            <th>Comment</th>

            <th>Status</th>
            <?php if ($this->session->userdata('adminAccess') == 'Yes') {  ?>
                <th>Updated By</th>
            <?php } ?>
            <th>Updated On</th>

        </tr>

    </thead>

    <tbody>

        <?php
        // print_r($comment);
        if (isset($comment) && !empty($comment)) {

            $i = 1;

            foreach ($comment as $item) {

                if ($item['comment'] != '') {

        ?>

                    <tr>

                        <td><?php echo $i ?></td>

                        <td><?php echo $item['comment'] ?></td>

                        <td><?php echo $item['status'] ?></td>
                        <?php if ($this->session->userdata('adminAccess') == 'Yes') {  ?>
                            <td><?php echo $item['full_name'] ?></td>
                        <?php } ?>
                        <td><?php echo $item['commented_on'] ?></td>

                    </tr>

            <?php

                    $i++;
                }
            }
        } else { ?>

            <tr>

                <td colspan="4">
                    <center>No Data Available</center>
                </td>

            </tr>

        <?php }

        ?>



    </tbody>

</table>