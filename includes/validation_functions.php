
<?php 
$errors = array();

function fieldname_as_text($fieldname)
{
    $fieldname = str_replace("_"," ",$fieldname);
    $fieldname = ucfirst($fieldname);
    return $fieldname;
}

//presence
function does_exist($value)
{
    return isset($value) && $value!=="";

}
function validate_presence($required_fields)
{
    global $errors;
    foreach ($required_fields as $field)
    {
        $value = trim($_POST[$field]);
        if (!does_exist($value))
        {
            $errors[$field] = fieldname_as_text ($field) . " can't be blank";
        }
    }
}

//string length

function max_length($value,$max)
{
    return strlen($value)>$max;
}
function validate_max_length($fields_with_max_lengths)
{
    global $errors;
        foreach ($fields_with_max_lengths as $field => $max)
        {
            $value = trim($_POST[$field]);
            if (max_length($value,$max))
            {
                $errors[$field] = fieldname_as_text($field) . " is too long";
            }
        }
}

//type

function search_array($value,$set){
    return in_array($value,$set);
}

 
?>
