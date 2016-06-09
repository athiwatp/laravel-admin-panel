/**
 * Created by Navdeep on 01-03-2016.
 */

var vm = new Vue({

    http: {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
        }
    },

    el: '#vue-container',

    data: {
        user: {
            name: '',
            email: '',
            password : ''
        }
    },

    methods: {
        getRecords: function () {
            this.$http.get('api/administrator', function (data) {
                this.$set('users', data)
            })
        },

        AddNewRecord: function () {
            this.$set('form.title', 'Add User');

            // Clear form input
            var user = {name: '', email: ''}
            this.$set('user', user);

            // Reload page
            this.getRecords();
        },

        EditRecord: function (id) {
            this.$set('form.title', 'Edit User');
            this.$http.get('api/administrator/'+id+'/edit', function (data) {
                this.$set('user', data);
                console.log(data);
            })
        },
        saveFormDetails: function(record) {
            console.log(record.id);
            if ( record.id == undefined ) {
                this.$http.post('api/administrator', this.user, function (data) {
                    this.postFormSubmission();
                });
            } else {
                this.$http.patch('api/administrator/'+record.id, this.user, function (data) {
                    this.postFormSubmission();
                });
            }
        },
        postFormSubmission : function() {
            this.getRecords();
            $("#formModal").modal('hide');
        },

        RemoveRecord: function (id) {
            var ConfirmBox = confirm("Are you sure, you want to delete this Record?");

            if (ConfirmBox) this.$http.delete('api/administrator/' + id);

            this.getRecords();
        }
    },

    computed: {
        validation: function () {
            return {
                name: !!this.newRecord.name.trim(),
                email: emailRE.test(this.newRecord.email),
                crud_level: !!this.newRecord.crud_level
            }
        },

        isValid: function () {
            var validation = this.validation
            return Object.keys(validation).every(function (key) {
                return validation[key]
            })
        }
    },

    ready: function () {
        this.getRecords()
    }

});