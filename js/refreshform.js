$(document).ready(function(){  
$("#submit").click(function(){
var name = $("#name").val();
var email = $("#email").val();
var contact = $("#contact").val();
var gender = $("input[type=radio]:checked").val();
var msg = $("#msg").val();

if(name ==''|| email==''|| contact==''|| gender==''|| msg==''){
alert("Insertion Failed Some Fields are Blank....!!");   	
}
else{
// Returns successful data submission message when the entered information is stored in database.
$.post("refreshform.php",{ name1: name, email1: email, contact1: contact, gender1:gender, msg1:msg},
			function(data) {
			alert(data);
			$('#form')[0].reset(); //To reset form fields
			});
    
    }
});
});
