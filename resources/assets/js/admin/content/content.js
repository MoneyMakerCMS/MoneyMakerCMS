var contentForm = new Vue({
    el: '#content-form',

    data: {
        database: null,
        type_select: null
    },
    ready: function() {
        this.database = Content.database

        $(this.$els.html).selectize({
            create: true,
            sortField: 'text'
        })

        $(this.$els.file).selectize({
            create: true,
            sortField: 'text'
        })

        $(this.$els.enabled).selectize({
            create: true,
            sortField: 'text'
        })

        var select = $(this.$els.typeselect).selectize({
            create: true,
            sortField: 'text'
        });

        this.type_select = select[0].selectize;
        this.type_select.on('change', this.toggleType);

    },
    methods: {

        toggleType: function(e) {
            var value = this.type_select.getValue();
            if (value === 'database') {
                this.$set('database', true);
            } else {
                this.$set('database', false);
            }

        }
    }
});

$(function() {
    $('#value').summernote({
        height: 300,
        tabsize: 2,
        lang: '{{app()->getLocale()}}'
    });

    $('#name').on('keyup', function(e) {
        if (String.prototype.slugify) {
            var input = $(this).data('slugify');
            var slug = $(this).val().slugify();
            $(input).val(slug);
        }
    });
});
