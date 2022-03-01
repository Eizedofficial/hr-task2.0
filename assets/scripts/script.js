$(document).ready(function () {
    $("#submitRoutersData").click(function () {
        try {
            let data = $('#routersData').serialize();
            data = data + '&action=storeEquipment';
            $.ajax({
                url: '/index.php',
                method: 'get',
                data: data
            }).done(function (response) {
                if (response.status === false) {
                    alert("Произошла ошибка.\n" + response.message);
                } else {
                    let errorMessage = "";
                    if (response.data.stored.length > 0) {
                        errorMessage += "Следующие серийные номера уже были в базе:\n";
                        response.data.stored.forEach((code) => errorMessage += code + "\n");
                    }
                    if (response.data.wrong.length > 0) {
                        errorMessage += "Следующие серийные номера не подходили по условиям валидации:\n";
                        response.data.wrong.forEach((code) => errorMessage += code + "\n");
                    }

                    if (errorMessage !== "") {
                        alert(errorMessage);
                    } else {
                        alert("Успешно");
                    }
                }
            });
        } catch (e) {
            window.open("https://stackoverflow.com/search?q=" + e.message, "_blank");
        }

        return false;
    })
})
