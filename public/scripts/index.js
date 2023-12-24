$(document).ready(function () {

    new DataTable("#myJournal");

    let globalRow = 0;
    let globalColm = 1;






    let numberRows = $('#game-table tr').length;
    console.log(numberRows);

    // $('#game-table input[type="number"]').val('');

    // $('#game-table .clear-class b').text('0');

    $('td, th').removeClass('bg-warning');

    let firstRow = $('tbody#game-table tr:first');
    firstRow.find('th').addClass('bg-warning');
    firstRow.find('td').addClass('bg-warning');

    $('tbody#game-table tr:first td:first input').focus();

    $('.btn-score').click(function () {

        let buttonText = $(this).text();
        let input = $(`input[data-row="${globalRow}"][data-colmn="${globalColm}"]`);
        input.css('border-color', 'red');
        input.val(buttonText)


        $('.player' + globalRow + '-row').each(function () {
            let totalScore = 0;
            $(this).find('.score-input-' + globalRow).each(function () {
                let score = parseInt($(this).val()) || 0;
                totalScore += score;
            });
            $(this).find('.player' + globalRow + '-total-score b').text(totalScore);

        });


        globalRow += 1;
        globalColm = globalColm;


        if (globalRow >= numberRows) {
            console.log("final");
            globalRow = 0;
            globalColm += 1;
        }


        $('th').removeClass('bg-warning');
        $('td').removeClass('bg-warning');

        let nextInput = $(`input[data-row="${globalRow}"][data-colmn="${globalColm}"]`)
        $(nextInput).closest('tr').find('td').addClass("bg-warning");
        $(nextInput).closest('tr').find('th').addClass("bg-warning");




    });





    function change(element) {
        const totalPlayers = element.val();
        const totalInput = [];

        $("#playerNameInputField").html('');

        for (let i = 1; i <= totalPlayers; i++) {
            totalInput.push(
                ` <div class="form-group row" style="justify-content: center">
                    <div class="col-sm-2">
                        <label for="pemain${i}"><p>Nama Pemain ${i}</p></label>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="pemain${i}" name="pemain[]" required placeholder="Pemain ${i}">
                    </div>
                </div>
                <div class="mt-5"></div>`
            );
        }

        $("#playerNameInputField").html(totalInput.join(''));
    }

    $("#total_player").on("change", function () {
        change($(this));
    });

    $("#total_player").on("keyup", function () {
        change($(this));
    });



    for (let i = 0; i < numberRows; i++) {

        $('.score-input-' + i).on('input', function () {
            $('.player' + i + '-row').each(function () {
                let totalScore = 0;
                $(this).find('.score-input-' + i).each(function () {
                    let score = parseInt($(this).val()) || 0;
                    totalScore += score;
                });
                $(this).find('.player' + i + '-total-score b').text(totalScore);

            });
        });


    }

    $('input.highlighted').click(function () {
        let focusedInputRow = $(this).data('row');
        let focusedInputColumn = $(this).data('colmn');

        globalRow = focusedInputRow;
        globalColm = focusedInputColumn;

        console.log(globalRow + "x" + globalColm);
        $('td, th').removeClass('bg-warning');

        $(this).closest('tr').find('td').addClass("bg-warning");
        $(this).closest('tr').find('th').addClass("bg-warning");
    });


    $("#clear_button").click(function () {
        $('#game-table input[type="number"]').val('');

        $('#game-table .clear-class b').text('0');

        globalRow = 0;
        globalColm = 1;

        $('td, th').removeClass('bg-warning');
        $('input').css('border-color', '')

        let firstRow = $('tbody#game-table tr:first');
        firstRow.find('th').addClass('bg-warning');
        firstRow.find('td').addClass('bg-warning');
        $('tbody#game-table tr:first td:first input').focus();

    });


    $("#previous_button").click(function () {
        $("#myForm").attr('action', '/session-previous');

    });


    $("#next_button").click(function () {
        $("#myForm").attr('action', '/session-next');

    });




});
