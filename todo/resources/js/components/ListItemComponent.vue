<template>
    <li class="w-100 list-group-item d-flex align-items-center">
        <div class="" style="margin-right:15px;">
            <input
                type="checkbox"
                @change="updateTaskState()"
                v-model="item.state"
                class="form-check-input"
            />
        </div>
        <div class="flex-fill">
            <span :class="[item.state ? 'completed text-success' : '', 'item']">
                {{item.name }}
            </span>

        </div>

        <div class="">
            <button class="delete btn btn-link btn-lg ml-3 "
                    @click="removeTask()">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </li>
</template>

<script>
export default {
    props: ["item"],
    computed: {
      
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
    width: 2em;
    height:2em;
}
.list-group-item {
    border-left:none;
    border-right:none;
}
.list-group-item:last-child {
    border-bottom:none;
}
.item {
    font-size:1.5em;
}

.delete i {
    font-size:2em;
}
.delete {
    color:#ddd;
}
.delete:hover {
    color:red;
}
</style>
