/**
 * 
 */

$(document).ready(function(){
	

	 $('#peopletbl').dataTable({
		 "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		
	     "displayLength": 25
	 });
	 
	 $("#dept").on("change",function(){
		 $("#dept_form").submit();
	 })
	 
	 $(".newlist").hide();
	 $(".uploadlist").hide();
	 
	 $(".add_new_list").on("click",function(){
		 $(".newlist").show();
		 $(".uploadlist").hide();
	 })
	 	 $(".upload_new_list").on("click",function(){
		 $(".newlist").hide();
		 $(".uploadlist").show();
	 })
})