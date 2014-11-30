$(document).ready(function () {
    function alignCenter(value) {
        return '<div style="text-align: center">' + value + '</div>';
    }

    var faqs = $('#faqs');

    var faqsTable = faqs.DataTable({
        searching: false,
        pagingType: "full_numbers",
        lengthMenu: [ [20, 50, 100, -1], [20, 50, 100, "Все"] ],
        language: {
            "sProcessing":   "Подождите...",
            "sLengthMenu":   "Показать _MENU_ записей",
            "sZeroRecords":  "Записи отсутствуют.",
            "sInfo":         "Записи с _START_ до _END_ из _TOTAL_ записей",
            "sInfoEmpty":    "Записи с 0 до 0 из 0 записей",
            "sInfoFiltered": "(отфильтровано из _MAX_ записей)",
            "sInfoPostFix":  "",
            "sSearch":       "Поиск:",
            "sUrl":          "",
            "oPaginate": {
                "sFirst": "Первая",
                "sPrevious": "Предыдущая",
                "sNext": "Следующая",
                "sLast": "Последняя"
            },
            "oAria": {
                "sSortAscending":  ": активировать для сортировки столбца по возрастанию",
                "sSortDescending": ": активировать для сортировки столбцов по убыванию"
            }
        },
        ajax: {
            url: "/assets/modules/faqcraft/connector.php/moduleAjax"
        },
        columns: [{
            data: "id",
            render: alignCenter
        }, {
            data: "question"
        }, {
            data: "active",
            render: function (value) {
                return alignCenter(value == 1 ? 'Да' : 'Нет')
            }
        }, {
            data: "category.title",
            render: alignCenter
        }, {
            data: "created_at",
            render: alignCenter
        }, {
            data: "updated_at",
            render: alignCenter
        }, {
            data: "id",
            sorting: false,
            orderable: false,
            render: function (value, type, row) {
                var btns = '';

                btns += '<a href="">Изменить</a>';
                btns += '<a href="">Удалить</a>';
                btns += '<a href="">Копировать</a>';

                return btns;
            }
        }]
    });
});
