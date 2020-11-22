<template>
    <table class="table">
        <thead>
        <tr>
            <th>Registration number</th>
            <th>Model</th>
            <th>Year</th>
            <th>Mileage</th>
            <th>Registation date</th>
            <th>Is veteran</th>

        </tr>
        </thead>
        <tbody>
        <tr v-for="vehicle in this.vehicles">
            <td>{{  vehicle.plate_number }}</td>
            <td>{{  vehicle.model }}</td>
            <td>{{  vehicle.year }}</td>
            <td>{{  vehicle.mileage }}</td>
            <td>{{  vehicle.registered_at }}</td>
            <td>{{  vehicle.veteran_status }}</td>
        </tr>
        </tbody>
    </table>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            vehicles: null,
        }
    },
    name: "Vehicles",
    mounted () {
        axios.get('api/v1/vehicles')
            .then(response => {
                this.vehicles = response.data

            })
            .catch(error => {
                console.error(error);
            });
    }
}

</script>

<style scoped>

</style>
