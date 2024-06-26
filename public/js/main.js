let is_file = 0;

// wizard

let current_fs, next_fs, previous_fs //fieldsets
let left, opacity, scale //fieldset properties which we will animate
let animating //flag to prevent quick multi-click glitches

$('.next').click(function () {
    if (is_file > 0) {
        if (animating) return false
        animating = true

        current_fs = $(this).parent().parent().parent().parent()
        next_fs = $(this).parent().parent().parent().parent().next()

        //activate next step on progressbar using the index of next_fs

        //show the next fieldset
        next_fs.show()
        //hide the current fieldset with style
        current_fs.animate(
            {opacity: 0},
            {
                step: function (now, mx) {
                    //as the opacity of current_fs reduces to 0 - stored in "now"
                    //1. scale current_fs down to 80%
                    // scale = 1 - (1 - now) * 0.2;
                    //2. bring next_fs from the right(50%)
                    left = now * 50 + '%'
                    //3. increase opacity of next_fs to 1 as it moves in
                    opacity = 1 - now
                    // current_fs.css({ 'transform': 'scale(' + scale + ')' });
                    next_fs.css({left: left, opacity: opacity})
                },
                duration: 800,
                complete: function () {
                    current_fs.hide()
                    animating = false
                },
                //this comes from the custom easing plugin
                easing: 'easeInOutBack',
            },
        )
    } else {
        Swal.fire({
            icon: 'warning',
            title: 'Warning',
            text: "Please upload at least one document. ",
            timer: 2000,
            showCancelButton: true,
            showConfirmButton: false
        });
    }
})
$('.previous').click(function () {
    if (animating) return false
    animating = true
    current_fs = $(this).parent().parent().parent().parent().parent()
    previous_fs = $(this).parent().parent().parent().parent().parent().prev()
    // current_fs = $(this).parent().parent();
    // previous_fs = $(this).parent().parent().prev();

    //show the previous fieldset
    previous_fs.show()
    //hide the current fieldset with style
    current_fs.animate(
        {opacity: 0},
        {
            step: function (now, mx) {
                //as the opacity of current_fs reduces to 0 - stored in "now"
                //1. scale previous_fs from 80% to 100%
                scale = 0.8 + (1 - now) * 0.2
                //2. take current_fs to the right(50%) - from 0%
                left = (1 - now) * 50 + '%'
                //3. increase opacity of previous_fs to 1 as it moves in
                opacity = 1 - now
                current_fs.css({left: left})
                previous_fs.css({transform: 'scale(' + scale + ')', opacity: opacity})
            },
            duration: 800,
            complete: function () {
                current_fs.hide()
                animating = false
            },
            //this comes from the custom easing plugin
            easing: 'easeInOutBack',
        },
    )
})

$('.submit').click(function () {
    return false
})
// wizard end

// close  button
$('.close-button').click(function () {
    $('#hire-popup').modal('hide')
})

$('.cancel-button').click(function () {
    $('#quote-popup').modal('hide')
})


$('.upload-file').on('change', function () {
    var filename = $(this).val()
    var attr = $(this).data('doc-type')
    var text = $('#' + attr + ' .file-upload-text').text()
    if (!filename) {
        $('#' + attr + ' .upload-wrapper').removeClass('success')
        $('.' + attr).remove()
    } else {
        is_file = ++is_file;
        filename = filename.replace('C:\\fakepath\\', '')
        $('#' + attr + ' .file-upload-name').html(filename)
        $('#' + attr + ' .upload-wrapper').addClass('uploaded')
        setTimeout(function () {
            $('#' + attr + ' .upload-wrapper').removeClass('uploaded')
            $('#' + attr + ' .upload-wrapper').addClass('success')
        }, 600)
        // Remove previous preview before adding the new one
        $('.' + attr).remove()
        let div =
            '<div class="attach-file ' +
            attr +
            '" data-doc-type-id="' +
            attr +
            '">' +
            '<span>' +
            '<p class="file-upload-name"></p>' +
            '</span>' +
            '<p>' +
            filename +
            '</p>' +
            '<div class="attach-icon">' +
            '<i class="fa-solid fa-circle-xmark"></i>' +
            '</div>' +
            '</div>'
        $('.attached-files-main').append(div)
    }
    $('.close-button').click(function () {
        $('#hire-popup').modal('hide')
    })
})
$(document).on('click', '.attach-icon', function () {
    let id = $(this).parent('.attach-file').attr('data-doc-type-id')
    let input = $(document).find("input[data-doc-type='" + id + "']")
    $(this).parent('.attach-file').remove()
    input.val('')
    input.parent().removeClass('success')
});

$(document).on('click', '.attach-icon', function () {
    if(is_file > 1){
        // $(this).parent('.attach-file').remove();
        let id = $(this).parent('.attach-file').attr('data-doc-type-id')
        let input = $(document).find("input[data-doc-type='" + id + "']")
        // input[0].files = null

        $(this).parent('.attach-file').remove()
        //  console.log(input[0].files)
        // console.log(input[0].files)

        // input.val('')
        input.val('')
        input.parent().removeClass('success')
        is_file = --is_file;
    } else{
        Swal.fire({
            icon: 'warning',
            title: 'Warning',
            text: "At least one document should be attached",
            timer: 2000,
            showCancelButton: true,
            showConfirmButton: false
        });
    }
})


// gallery slider


// gallery slider end
