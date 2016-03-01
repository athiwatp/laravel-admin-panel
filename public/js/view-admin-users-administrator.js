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
        newRecord: {
            id: '',
            name: '',
            email: '',
            crud_level: ''
        },

        success: false,

        edit: false,

        showForm : false
    },

    methods: {
        setShowForm: function(event){
            this.showForm = true;
            this.edit = false;
            this.newRecord.id = '';
            this.newRecord.name = '';
            this.newRecord.email = '';
            this.newRecord.crud_level = '';
        },

        getRecords: function () {
            this.$http.get('api/administrator', function (data) {
                this.$set('users', data)
            })
        },


        ShowRecord: function (id) {
            this.showForm = true;
            this.edit = true;

            this.$http.get('/api/v1/records/' + id, function (data) {
                this.newRecord.id = data.id;
                this.newRecord.name = data.name;
                this.newRecord.email = data.email;
                this.newRecord.crud_level = data.crud_level
            })
        },

        AddNewRecord: function () {
            // User input
            var record = this.newRecord;

            // Clear form input
            this.newRecord = {name: '', email: '', crud_level: ''}

            // Send post request
            this.$http.post('/api/v1/records/', record);

            // Show success message
            self = this;
            this.success = true;
            setTimeout(function () {
                self.success = false
            }, 5000);

            // Reload page
            this.getRecords();
        },

        EditRecord: function (id) {
            var record = this.newRecord;

            this.newRecord = {id: '', name: '', email: '', address: ''}

            this.$http.patch('/api/v1/records/' + id, record, function (data) {
                console.log(data)
            });

            this.getRecords();

            this.edit = false;

        },

        RemoveRecord: function (id) {
            var ConfirmBox = confirm("Are you sure, you want to delete this Record?");

            if (ConfirmBox) this.$http.delete('/api/v1/records/' + id);

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

