.validate(options)
    return: Validator

    options:
        debug: true/false
        submitHandler:
            `function(form){}`
        invalidHandler:
            `function(event, validator){}`
        ignore: <selector>
        rules:
            ```
            {
                name: {
                    required: true
                    min: {
                        param: 15,
                        depends: function(element) {
                            return $('#bonus-material').is(':checked');
                        }
                    }
                }
            }
            ```
        messages:
            ```
            {
                name: {
                    required: "this field is required",
                    minlength: jQuery.validator.format("At least {0}")
                }
            }
            ```
        groups:
            `{usrename: "fname lname"}`
        errorPlacement:
            `function(error, element) {}`
        onsubmit:
            `false` |
            `function() {}`
        onfocusout:
            `false` |
            `function(element) {}`
        onkeyup:
            `false` |
            `function(element, event) {}`
        onclick:
            `false` |
            `function(element, event) {}`
        focusInvalid: `false`
        focusCleanup: `true`
        errorClass: <className>
        validClass: <className>
        errorElement: <elementName>
        wrapper: <elementName>
        errorLabelContainer: <selector>
        errorContainer: <selector>
        showErrors:
            `function(errorMap, errorList) {}`
        success:
            `function(label, element) {}`
        highlight:
            `function(element, errorClass, validClass) {}`
        unhighlight:
            `function(element, errorClass, validClass) {}`
        ignoreTitle: `true` | `false`

Validator
    .form()
    .element()
    .resetForm()
    .showErrors()
    .numberOfInvalids()

    .addMethod()
    .format()
    .setDefaults()
    .addClassRules()

Build-in validation methods:
    required
    remote:
        ```
        {
            url: "check-email.php",
            type: "post",
            data {
                username: function() {
                    return $("#username").val();
                }
            }
        }
        ```
    minlength
    maxlength
    rangelength
    min
    max
    range
    email
    url
    date
    dateISO
    number
    digits
    creditcard
    equalTo