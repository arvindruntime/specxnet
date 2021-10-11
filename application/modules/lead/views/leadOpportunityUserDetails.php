<?php
$value = $users[0];
// print_r($value);exit;
?>
<style type="text/css">
    .table td {
        padding:10px !important;
    }
    .table th {
        padding:10px !important;
        font-weight: bold !important;
    }
    .table-bordered th, .table-bordered td {
        border: 1px solid #bfc2cc;
    }
</style>
<table class="table table-bordered">
    <tr>
        <td>Name</td><th><?php echo isset($value['first_name'])?$value['first_name']:''; ?></th>
        <td>Last Name</td><th><?php echo isset($value['last_name'])?$value['last_name']:''; ?></th>
    </tr>

    <tr>
        <td>Designation</td><th><?php echo isset($value['designation'])?$value['designation']:'--'; ?></th>
        <td>Company</td><th><?php echo isset($value['company_name'])?$value['company_name']:'--'; ?></th>
    </tr>
    <tr>
        <td>Street Address</td><th><?php echo isset($value['street_address'])?$value['street_address']:'--'; ?></th>
        <td>City</td><th><?php echo isset($value['city'])?$value['city']:'--'; ?></th>
    </tr>
    <tr>
        <td>State</td><th><?php echo isset($value['state'])?$value['state']:'--'; ?></th>
        <td>Pincode</td><th><?php echo isset($value['pincode'])?$value['pincode']:''; ?></th>
    </tr>
    <tr>
        <td>Country</td><th colspan="3"><?php echo isset($value['country'])?$value['country']:''; ?></th>
    </tr>
</table>
<table class="table table-bordered">
    <tr>
        <th colspan="2">Contact Details</th>
    </tr>
<?php
$userContact = explode(',', $value['user_info']);
foreach ($userContact as $userContact) {
    $newValue = explode('_', $userContact);
?>
    <tr>
        <td><?php echo $newValue[1]?></td>
        <th><?php echo $newValue[0]?></th>
    </tr>
<?php
}
?>
</table>
    