$(document).ready(function () {
    console.log(window.location.pathname)
    if (window.location.pathname.match(/^\//)[0] === window.location.pathname
        || window.location.pathname.match(/^\/announcements/)[0] === window.location.pathname) {
        $.get({
            url: '/announcements',
            success: function (data) {
                $('#announcements').empty()
                renderIndex(data)
            },
            error: function (error) {
                console.log(error)
            }
        })
    } else if (window.location.pathname.match(/^\/announcement\/d+/)
        && window.location.pathname.match(/^\/announcement\/d+/)[0] === window.location.pathname) {

        $.get({
            url: window.location,
            success: function (data) {
                renderDetail(data)
            },
            error: function (error) {
                console.log(error)
            }
        })
    }

    $(document).on('click', '.card-link', function (e) {
        e.preventDefault()
        $.get({
            url: $(this).attr('href'),
            success: function (data) {
                if (data.length > 0) {
                    renderIndex(data)
                } else {
                    renderDetail(data)
                }
            },
            error: function (error) {
                console.log(error)
            }
        })
    })

    $(document).on('click', '.page-link', function (e) {
        e.preventDefault()
        $('.page-item.active').removeClass('active')
        $(this).parent().addClass('active')

        var url = new URL(window.location.href)
        url.pathname = 'announcements'
        url.searchParams.set('page', $(this).attr('href'))
        window.history.replaceState({page: url.searchParams.get('page')}, 'page', url)

        $.get({
            url: url,
            success: function (data) {
                renderIndex(data)
            },
            error: function (error) {
                console.log(error)
            }
        })
    })

    $(document).on('click', '.sort', function (e) {
        e.preventDefault()

        var page =$('.page-item.active').find('.page-link').attr('href')
        var url = new URL(window.location.href)
        url.pathname = 'announcements'
        url.searchParams.set('sort', $(this).data('sort'))
        url.searchParams.set('order', $(this).data('order'))

        window.history.replaceState({page: url.searchParams.get('page')}, 'page', url)

        if ($(this).data('order') === 'asc') {
            $(this).data('order', 'desc')
        } else {
            $(this).data('order', 'asc')
        }

        $.get({
            url: url,
            success: function (data) {
                renderIndex(data)
            },
            error: function (error) {
                console.log(error)
            }
        })
    })

    $(document).on('click', '.create-announcement button', function () {
        $('.is-invalid').removeClass('is-invalid')
        $.ajax({
            url: $('.create-announcement form').attr('action'),
            type: 'post',
            data: {
                title: $('input[name="title"]').val(),
                price: $('input[name="price"]').val(),
                description: $('textarea[name="description"]').val(),
                token: $('input[type="hidden"]').val()
            },
            success: function (data) {
                $('.alert.alert-danger').addClass('d-none')
                $('.alert.alert-success')
                    .removeClass('d-none')
                    .text(data.flash)

                $('.form-control').val('')
            },
            error: function (error) {
                $('.alert.alert-success').addClass('d-none')
                if (error.status === 400) {
                    if (error.responseJSON.error) {
                        $('.alert.alert-danger')
                            .removeClass('d-none')
                            .text(error.responseJSON.error)
                    } else {
                        $.each(error.responseJSON, function (i, value) {
                            $(`[name="${i}"]`)
                                .addClass('is-invalid')
                                .next().text(value)
                        })
                    }
                }
            }
        })
    })

    var renderIndex = function (data) {
        $('#announcements').empty()
        $.each(data, function (i, announcement) {
            $('#announcements').append(announcementTemplateIndex(announcement))
        })
    }

    var renderDetail = function (data) {
        $('#announcements').html(announcementTemplateDetail(data))
    }

    var announcementTemplateIndex = function (data) {
        return `<div class="card m-auto" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">${data.title}</h5>
                        <div class="card-subtitle mb-2 text-muted">ID ${data.id}</div>
                        <p class="card-text">Цена: ${data.price}</p>
                        <a href="/announcement/${data.id}" class="card-link">Ссылка на детальный просмотр</a>
                    </div>
                 </div>`
    }

    var announcementTemplateDetail = function (data) {
        return `<div class="card m-auto" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">${data.title}</h5>
                        <div class="card-subtitle mb-2 text-muted">ID ${data.id}</div>
                        <p class="card-text">Цена: ${data.price}</p>
                        <p class="card-text">Описание: ${data.description}</p>
                        <a href="/announcements" class="card-link">На главную</a>
                    </div>
                 </div>`
    }
})


