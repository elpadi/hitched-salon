<?php
echo $before_widget;
if (!empty($title)) {
	echo $before_title, $title, $after_title;
}
?>
<form name="previewForm" method="post" action="https://secure.campaigner.com/CSB/Public/ProcessHostedForm.aspx" id="previewForm" enctype="multipart/form-data" target="_blank">
<script type="text/javascript">
//<![cdata[
var theForm = document.forms['previewForm'];
if (!theForm) {
    theForm = document.previewForm;
}
function __doPostBack(eventTarget, eventArgument) {
    if (!theForm.onsubmit || (theForm.onsubmit() != false)) {
        theForm.__EVENTTARGET.value = eventTarget;
        theForm.__EVENTARGUMENT.value = eventArgument;
        theForm.submit();
    }
}
//]]>
</script>
<input name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="5523BD75" type="hidden">
<input name="1698800" maxlength="500" id="1698800" class="serif" placeholder="EMAIL ADDRESS" contactattributeid="1698800" type="email" required>
<input name="SubmitButton" value="Submit" id="SubmitButton" class="clean-button bold" type="submit">
<input name="FormInfo" id="FormInfo" value="2b881935-3e0d-4584-9059-773857c44691" type="hidden">
</form>
<?php echo $after_widget; ?>