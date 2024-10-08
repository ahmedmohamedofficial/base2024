<script>
    getData()
    // input date js
    var $list = $(":input[type='date']");
    $(window).on('load', function() {
        if ($($list).length > 0) {
            $(document).find($list).addClass("custom-input-date");
            $(document).find($list).parents(".controls").addClass("parent-input-date");
        }

        var statrtLength        =   $('#start').length;
        var endLength           =   $('#start').length;


        if(statrtLength > 0 && endLength > 0){
            var start = flatpickr(document.querySelector('#start'), {
                wrap: true,
                disableMobile: true,
                locale: "{{ app()->getLocale() }}",
                dateFormat: "m-d-Y",
                onChange: function(selectedDates, dateStr, instance) {
                    end.set('minDate', dateStr);
                }
            });

            var end = flatpickr(document.querySelector('#end'), {
                wrap: true,
                disableMobile: true,
                locale: "{{ app()->getLocale() }}",
                dateFormat: "m-d-Y",
                onChange: function(selectedDates, dateStr, instance) {
                    start.set('maxDate', dateStr);
                }
            });
        }

    });

    $('.exportExcel').on('click', function (){
        event.preventDefault();
        var baseUrl = $(this).attr('href');
        var queryString = '';



        for (var key in searchArray()) {
            if (searchArray().hasOwnProperty(key)) {
                if (queryString.length > 0) {
                    queryString += '&';
                }
                queryString +=  key +'=' + encodeURIComponent(searchArray()[key]);
            }
        }

        var url = baseUrl + '?' + queryString;

        window.location.href = baseUrl + '?' + queryString;
    });



    $(".btn-searchTable").on("click", function(e) {
        e.stopPropagation();
        $(this).toggleClass("active");
        if ($(this).hasClass("active")) {
            $(".searchTable , .layout_").addClass("active");
        } else {
            $(".searchTable , .layout_").removeClass("active");
        }
    });

    $(".btnClose").on("click" , function () {
        $(".searchTable , .layout_").removeClass("active");
    });

    $(".layout_").on("click" , function () {
        $(".btn-searchTable.active").click();
    });

    function searchArray() {
        var searchArray = {} ;
        $('.searchInput').each(function(key, input) {
            searchArray[$(this).attr('name')] = $(this).val()
        });
        return  searchArray
    }

    $(document).on('change', '.searchInput', function (e) {
        e.preventDefault();
        getData(searchArray() )
    });

    $(document).on('click', '.reload', function (e) {
        e.preventDefault();
        getData()
    });

    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        getData({page : $(this).attr('href').split('page=')[1]   }, searchArray() )
    });



    function getData(array) {
        $.ajax({
            type: "get",
            url: "{{$index_route}}",
            data: array,
            dataType: "json",
            cache: false ,
            beforeSend: function() {
                $('.table_content_append').block({
                    message:
                        '<div class="d-flex justify-content-center gap-3"><p class="mb-0">{{__('admin.loading')}} </p> <div class="sk-wave m-0"><div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div></div> </div>',
                    timeout: 10000000000000,
                    css: {
                        backgroundColor: 'transparent',
                        color: '#fff',
                        border: '0'
                    },
                    overlayCSS: {
                        opacity: 0.5
                    }
                });
            },
            success: function (response) {
                $('.table_content_append').html(response.html)
            }
        });
    }

    $('.clean-input').on('click' ,function(){
        $(this).siblings('input').val(null);
        $(this).siblings('select').val(null);
        getData(searchArray())
    });
</script>