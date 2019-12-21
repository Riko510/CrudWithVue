new Vue({
    el: '#student_form',
    data: {
        items: [],
        addBtn: false,
        deleteBtn: false,
        modifyBtn: false,
        dataId:'',
        addName:'',
        addEmail:'',
        addPhone:'',
        modifyName:'',
        modifyEmail:'',
        modifyPhone:'',
    },
    mounted() {
        this.getStudentData();
    },
    methods: { 
        getStudentData: function(){
            let self = this;
            $.ajax({
                url:'./database/index.php',
                method:'GET',
                type:'json',
            })
            .done(function(data){
                self.items = JSON.parse(data);
            })
            .fail(function(error){
                console.log(error);
            });
        },
        deleteStudentData: function(){
            let self = this;
            $.ajax({
                url:'./database/crud.php',
                method: 'POST',
                dataType: 'json',
                data:{
                    'category':'delete',
                    'id': self.dataId,
                },
            })
            .done(function(){
                self.getStudentData();
                self.dataId = '';
            })
            .fail(function(error){
                console.log(error);
            });
            this.deleteBtn = false;
        },
        addStudentData: function() {
            let self = this;
            $.ajax({
                url:'./database/crud.php',
                method: 'POST',
                dataType: 'json',
                data:{
                    'category':'add',
                    'id': self.dataId,
                    'name': self.addName,
                    'email': self.addEmail,
                    'phone': self.addPhone,
                },
            })
            .done(function(){
                self.getStudentData();
                self.dataId = '';
                self.addName = '';
                self.addEmail = '';
                self.addPhone = '';
            })
            .fail(function(error){
                console.log(error.responseText);
            });
            this.addBtn = false;
        },
        modifyStudentData: function() {
            let self = this;
            $.ajax({
                url:'./database/crud.php',
                method: 'POST',
                dataType: 'json',
                data:{
                    'category':'modify',
                    'id': self.dataId,
                    'name': self.modifyName,
                    'email': self.modifyEmail,
                    'phone': self.modifyPhone,
                },
            })
            .done(function(){
                self.getStudentData();
                self.dataId = '';
            })
            .fail(function(error){
                console.log(error.responseText);
            });
            this.modifyBtn = false;
        },
    },
})