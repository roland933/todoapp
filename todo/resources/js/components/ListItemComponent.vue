<template>
    <li class="w-100 list-group-item d-flex align-items-center">
        <div class="" style="margin-right:15px;">
            <input
                type="checkbox"
                @change="updateTaskState()"
                v-model="item.state"
                :disabled=" userCantChecked"
                class="form-check-input"
            />
        </div>
        <div class="flex-fill">
            <input class="form-control edit-name-input"
                   @change="updateTaskName()" 
                   v-model="item.name" 
                   v-if="edit"/>
            <span :class="[item.state ? 'completed text-success' : '', 'item']"  v-if="!edit">
                {{item.name }}
            </span>

        </div>

        <div class="">
            <button class="delete btn btn-link btn-lg ml-3 "
                    @click="removeTask()">
                <i class="fas fa-times"></i>
            </button>
            <button class="edit btn btn-link btn-lg ml-3 "
                    :disabled="userCantEdit"
                    @click="editTask()">
                <i class="fas fa-edit"></i>
            </button>
        </div>
    </li>
</template>

<script>
export default {
    props: ["item"],
  
    data: function(){
        return {
            edit:false,
            name: this.item.name
        }
    },
    computed: {
        userCantEdit() {
            return this.item.state == true
        },
        userCantChecked() {
            return this.edit == true
        }
    },
    methods: {
        updateTaskState() {
            axios
                .put(`api/task/${this.item.id}`, {
                    item: this.item
                })
                .then(res => {
                    if (res.status === 200) {
                        console.log(res);
                        this.edit = false;
                        //this.$emit("itemchanged");
                    }
                })
                .catch(error => {
                    console.log("error from axios put", error);
                });
        },
        editTask() {
            this.edit = !this.edit
        },
        updateTaskName() {
            if(this.item.name === "") {
                this.item.name = this.name;
                return;
            }
            axios
                .put(`api/task/${this.item.id}`, {
                    item: this.item
                })
                .then(res => {
                    if (res.status === 200) {
                        console.log(res);
                        this.edit = false;
                        //this.$emit("itemchanged");
                    }
                })
                .catch(error => {
                    console.log("error from axios put", error);
                });
        },
        removeTask() {
            axios
                .delete(`api/task/${this.item.id}`)
                .then(res => {
                    if (res.status === 200) {
                        this.$emit("itemchanged");
                    }
                })
                .catch(error => {
                    console.log("error from axios delete ", error);
                });
        }
    }
};
</script>
<style  scoped>
span.completed {
    text-decoration: line-through;
}
.form-check-input {
    width: 1.5em;
    height:1.5em;
}
.list-group-item {
    border-left:none;
    border-right:none;
}
.list-group-item:last-child {
    border-bottom:none;
}
.item,.edit-name-input {
    font-size:1.5em;

}

.delete i, .edit i {
    font-size:1.5em;
}
.delete {
    color:#ddd;
}
.delete:hover {
    color:red;
}
</style>
