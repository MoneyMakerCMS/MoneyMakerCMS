var pageForm = new Vue({
    el: '#page-form',
    data: {
        database: null,
        type_select: null
    },
    mounted() {

        this.database = Page.database

        $(this.$refs.layout).selectize({
            create: true,
            sortField: 'text'
        })

        $(this.$refs.file).selectize({
            create: true,
            sortField: 'text'
        })

        $(this.$refs.active).selectize({
            create: true,
            sortField: 'text'
        })

        $(this.$refs.ab).selectize({
            create: true,
            sortField: 'text'
        })
        var select = $(this.$refs.typeselect).selectize({
            create: true,
            sortField: 'text'
        })

        this.type_select = select[0].selectize
        this.type_select.on('change', this.toggleType)
        
        $(this.$refs.middleware).selectize({
            create: false,
            sortField: 'text'
        })

    },
    methods: {

        toggleType: function(e) {
            var value = this.type_select.getValue()
            if (value === 'database') {

                this.database = true
            } else {
                this.database = false
            }

        }
    }
})

$('#robots').selectize({
    create: true,
    sortField: 'text'
})

$('#keywords').selectize({
    delimiter: ',',
    persist: false,
    create: function(input) {
        return {
            value: input,
            text: input
        }
    }
})

$(function() {
    $('#content').summernote({
        height: 300,
        tabsize: 2
    })

    $('#name').on('keyup', function(e) {

        if (String.prototype.slugify) {
            var input = $(this).data('slugify')

            var slug = $(this).val().slugify()

            $(input).val(slug)
        }
    })
})

$('.nav-tabs a').click(function(e) {
    e.preventDefault()
    $(this).tab('show')
})
