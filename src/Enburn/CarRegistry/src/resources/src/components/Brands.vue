<template>
    <div>
        <p>Brands and associated models: </p>
        <ul>
            <li v-for="(brand, index) in this.brands">
                <span class="has-text-weight-bold">{{ brand.name }}</span>
                <a v-on:click="editBrand(index)" class="mdi mdi-pencil has-text-info"></a>
                <a v-on:click="deleteBrand(brand.id)" class="mdi mdi-trash-can-outline has-text-danger"></a>
                <ul>
                    <li v-for="(model, modelIndex) in brand.vehicle_models">
                        {{ model.name }} -
                        {{ model.number_of_seats }} -
                        {{ model.fuel_type }} -
                        <a v-on:click="editVehicleModel(index, modelIndex)" class="mdi mdi-pencil has-text-info"></a>
                        <a v-on:click="deleteVehicleModel(brand.id, model.id)" class="mdi mdi-trash-can-outline has-text-danger"></a>
                    </li>
                </ul>
            </li>
            <div>
                <p v-on:click="displayNewBrand = true" class="mdi mdi-plus-circle has-text-success">Add or rename brand</p>
                <span v-if="displayNewBrand">
                    <input class="input" name="name" type="text" v-model="newBrandName">
                    <button v-bind:class="{ 'is-loading': this.newBrandLoading }" v-on:click="this.saveNewBrand" class="button is-success">Save brand</button>
                </span>
            </div>
            <div>
                <p v-on:click="displayNewModel = true" class="mdi mdi-plus-circle has-text-success">Add or change model</p>
                <span v-if="displayNewModel">
                    <label>
                        Brand
                        <select class="select" v-model="newModelBrandId">
                            <option v-for="brand in this.brands" :value="brand.id">{{ brand.name }}</option>
                        </select>
                    </label>
                    <label>
                        Name
                        <input class="input" type="text" v-model="newModelName">
                    </label>
                    <label>
                        Number of seats
                        <input class="input" type="number" v-model="newModelSeats">
                    </label>
                    <label>
                        Fuel type
                        <select class="select" v-model="newModelFuelType">
                            <option value="Gasoline">Gasoline</option>
                            <option value="Diesel">Diesel</option>
                            <option value="Electrical">Electrical</option>
                            <option value="Hybrid">Hybrid</option>
                        </select>
                    </label>
                    <button v-bind:class="{ 'is-loading': this.newModelLoading }" v-on:click="this.saveNewModel" class="button is-success">Save model</button>
                </span>
            </div>
        </ul>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            brands: null,
            displayNewBrand: false,
            displayNewModel: false,

            newBrandLoading: false,
            newModelLoading: false,

            newBrandName: null,
            newBrandId: null,

            newModelBrandId: null,
            newModelName: null,
            newModelSeats: null,
            newModelFuelType: null,
            newModelId: null,
        }
    },
    name: "Brands",
    methods: {
        saveNewBrand() {
            this.newBrandLoading = true;
            const data = {
                'id': this.newBrandId,
                'name': this.newBrandName,
            };

            if (data.id === null) {
                delete data.id;
            }

            axios.post('api/v1/brands/', data)
                .then(response => {
                    this.newBrandLoading = false;
                    this.newBrandId = null;
                    this.newBrandName = null;
                    this.getBrands();
                })
                .catch(error => {
                    console.error(error);
                    this.newBrandLoading = false;
                    this.getBrands();
                });
        },
        saveNewModel() {
            this.newModelLoading = true;
            const data = {
                'id': this.newModelId,
                'brand_id': this.newModelBrandId,
                'name': this.newModelName,
                'number_of_seats': this.newModelSeats,
                'fuel_type': this.newModelFuelType
            };

            if (data.id === null) {
                delete data.id;
            }

            axios.post('api/v1/models/', data)
                .then(response => {
                    this.newModelLoading = false;
                    this.newModelId = null;
                    this.newModelBrandId = null;
                    this.newModelName = null;
                    this.newModelSeats = null;
                    this.newModelFuelType = null;
                    this.getBrands();
                })
                .catch(error => {
                    console.error(error);
                    this.newModelLoading = false;
                    this.getBrands();
                });
        },
        editBrand(index) {
            this.displayNewBrand = true;
            this.newBrandName = this.brands[index].name
            this.newBrandId = this.brands[index].id
        },
        editVehicleModel(brandIndex, modelIndex) {
            this.displayNewModel = true;
            const model = this.brands[brandIndex].vehicle_models[modelIndex];

            this.newModelId = model.id;
            this.newModelBrandId = model.brandId;
            this.newModelName = model.name;
            this.newModelSeats = model.number_of_seats;
            this.newModelFuelType = model.fuel_type;
        },
        deleteBrand(brandId) {
            axios.delete('api/v1/brands/' + brandId)
                .then(response => {
                    this.getBrands();
                })
                .catch(error => {
                    console.error(error);
                    this.getBrands();
                });
        },
        deleteVehicleModel(brandId, ModelId) {
            axios.delete('api/v1/models/' + ModelId)
                .then(response => {
                    this.getBrands();
                })
                .catch(error => {
                    console.error(error);
                    this.getBrands();
                });
        },
        getBrands() {
            axios.get('api/v1/brands')
                .then(response => {
                    this.brands = response.data
                })
                .catch(error => {
                    console.error(error);
                });
        }
    },
    mounted () {
        this.getBrands();
    }
}
</script>

<style scoped>

</style>
