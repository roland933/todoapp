<template>
    <div class="m-auto  mt-3">
        <h1 class="text-primary text-center">Todo App</h1>
        <add-item-form v-on:reloadlist="getItems()" />
          <div class="col-3">
            <label>Filter state</label>
                <select class="form-control  form-control-sm"
                        @change="filterState()"
                        v-model="state"
                    >
                    <option value="">All</option>
                    <option value="0">Progress</option>
                    <option value="1">Completed</option>
                </select>
          </div>
            <list-view
                :items="items"
                v-on:reloadlist="getItems()"
            />
    </div>
</template>

<script>
import addItemForm from "./addItemForm";
import listView from "./ListViewComponent";

export default {
    components: {
        addItemForm,
        listView
    },

    data: function() {
        return {
            items: [],
            state: ""
        };
    },
    methods: {
        getItems() {
            axios
                .get("api/tasks")
                .then(res => {
                    console.log(res.data)
                    this.items = res.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        filterState() {

            axios
                .post("api/task/filter/", {
                    state: this.state

                })
                .then(res => {
                    if (res.status === 200) {
                        console.log(this.items);
                        this.items = res.data.task

                    }
                })
                .catch(error => {
                    console.log(error);
                });
        }
    },
    created() {
        this.getItems();
    }
};
</script>

<style scoped>

</style>
