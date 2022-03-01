$(document).ready(function(){
    $("#submitRoutersData").click(function(){
        event.preventDefault()
        $.ajax({
            url: '/addRouter.php',
            method: 'get',
            data: $('#routersData').serialize()
        }).done(function(response) {
            let errorMessage = "";
            if(response.stored.length > 0) {
                errorMessage += "Следующие серийные номера уже были в базе:\n";
                response.stored.forEach((code) => errorMessage += code + "\n");
            }
            if(response.wrong.length > 0) {
                errorMessage += "Следующие серийные номера не подходили по условиям валидации:\n";
                response.wrong.forEach((code) => errorMessage += code + "\n");
            }

            if(errorMessage !== "") {
                alert(errorMessage);
            } else {
                alert("Успешно");
            }
        });
    })
})
