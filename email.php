<html>
<head>
<script src="jquery-1.7.1.min.js" type="text/javascript"></script>
<script src="jquery.validate.min.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
  jQuery.validator.addMethod("multiemail", function (value, element) {
        if (this.optional(element)) {
            return true;
        }
        var emails = value.split(','),
            valid = true;
        for (var i = 0, limit = emails.length; i < limit; i++) {
            value = emails[i];
            valid = valid && jQuery.validator.methods.email.call(this, value, element);
        }
        return valid;
    }, "Please separate email addresses with a comma and do not use spaces.");


 $("#emailFrm").validate({
    errorElement:'div',
    rules: {
        emails: {
            required: true,
            multiemail:true
        }
    },
    messages: 
    {
        emails: {
            required:"Please enter email address."
        }
    }
 });
});
</script>
</head>
<body>
<form method="post" id="emailFrm">
<input type="text"  name="emails"  />
<input type="submit" name="submit" value="submit">
</form>
</body>
</html>
