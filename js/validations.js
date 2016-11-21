//If course hasn't been selected, blocked to user so has to choose first the department
function validateCourse() {
    var ddl = document.getElementById("departmentSelection");
    if (ddl.selectedIndex != 0) {
        document.getElementById("courseSelection").disabled = false; 
        var div = document.getElementById("showform");
        div.style.display = "none";
    }
}

function validate() {
    var ddl = document.getElementById("departmentSelection");
    if (ddl.selectedIndex == 0) {
        alert("Debe elegir primero un departamento");
        document.getElementById("courseSelection").disabled = true;
        document.getElementById('courseSelection').value="Elija un curso";
    }
}

function showhide() {
    var option = document.getElementById("courseSelection").value;
    var div = document.getElementById("showform");
    if (option == "course4") {
        div.style.display = "block";
    } else {
        div.style.display = "none";
    }
}

//Function using ajax to recover the data from the db and display it in the select tag depending of the department the user choose
function getIdCourse(val) {
	$.ajax({
		type: "POST",
		url: "getData.php",
		data: "id_department="+val,        
		success: function(data){
			$("#courseSelection").html(data);
		}
	});
}

function getIdProfessor() {
    var x = document.getElementById("departmentSelection");
    var val = x.options[x.selectedIndex].value;
    $.ajax({
        type: "POST",
        url: "getDataTwo.php",
        data: "id_department="+val,        
        success: function(data){
            $("#professorSelection").html(data);
        }
    });
}

setTimeout(function() {
    $('.success').fadeOut('slow');
}, 1000); // <-- time in milliseconds
setTimeout(function() {
    $('.info').fadeOut('slow');
}, 1000); // <-- time in milliseconds
setTimeout(function() {
    $('.warning').fadeOut('slow');
}, 1000); // <-- time in milliseconds
setTimeout(function() {
    $('.error').fadeOut('slow');
}, 1000); // <-- time in milliseconds
setTimeout(function() {
    $('.validation').fadeOut('slow');
}, 1000); // <-- time in milliseconds