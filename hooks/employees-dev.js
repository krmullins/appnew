$j(function () {

 
    $j('#BirthDate-dd, #BirthDate-mm, #BirthDate').change(function(){
        var dob = get_date('BirthDate');
        var today = new Date();
        var age = Math.floor((today - dob) / 1000 / 60 / 60 / 24 / 365.25);

        $j('#Age').val(age);
    });
});