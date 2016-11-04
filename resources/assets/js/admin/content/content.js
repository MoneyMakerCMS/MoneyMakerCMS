new Vue({
    el: '#content-form',
    data() {
        return {
            database: false,
            type_select: null
        }
    },

    mounted() {
        this.database = Content.database

        $(this.$refs.html).selectize({
            create: false,
            sortField: 'text'
        })

        $(this.$refs.filepicker).selectize({
            create: false,
            sortField: 'text'
        })

        $(this.$refs.enabled).selectize({
            create: false,
            sortField: 'text'
        })

        var select = $(this.$refs.typeselect).selectize({
            create: false,
            sortField: 'text'
        });


        this.type_select = select[0].selectize;
        this.type_select.on('change', this.toggleType)
        this.initSummerNote()
    },
    methods: {

        toggleType(e) {
                this.type_select.getValue() === 'database' ? this.database = true : this.database = false
                if (!this.database) {
                    return
                }
                this.initSummerNote()
            },

            initSummerNote() {

                $('#value').summernote({
                    height: 300,
                    tabsize: 2
                });
            }
    }
})

$(function() {
    $('#name').on('keyup', function(e) {
        if (String.prototype.slugify) {
            var input = $(this).data('slugify')
            var slug = $(this).val().slugify()
            $(input).val(slug)
        }
    });
});
