<template>
    <div>
        <div class="container mt-4">
      <form @submit.prevent="search">
        <div class="row">
          <div class="col-md-6">
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" v-model="name" id="name" class="form-control" placeholder="Name">
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label for="bedrooms" class="form-label">Bedrooms</label>
              <input type="number" v-model="bedrooms" id="bedrooms" class="form-control" placeholder="Bedrooms">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="mb-3">
              <label for="bathrooms" class="form-label">Bathrooms</label>
              <input type="number" v-model="bathrooms" id="bathrooms" class="form-control" placeholder="Bathrooms">
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label for="storeys" class="form-label">Storeys</label>
              <input type="number" v-model="storeys" id="storeys" class="form-control" placeholder="Storeys">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="mb-3">
              <label for="garages" class="form-label">Garages</label>
              <input type="number" v-model="garages" id="garages" class="form-control" placeholder="Garages">
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <label for="price_from" class="form-label">Price From</label>
              <input type="number" v-model="price_from" id="price_from" class="form-control" placeholder="Price from">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="mb-3">
              <label for="price_to" class="form-label">Price To</label>
              <input type="number" v-model="price_to" id="price_to" class="form-control" placeholder="Price to">
            </div>
          </div>
          <div class="col-md-6">
            <div class="mb-3">
              <button type="submit" class="btn btn-primary">Search</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  
      <table v-if="houses.length" class="table mt-4">
        <thead>
          <tr>
            <th>Name</th>
            <th>Bedrooms</th>
            <th>Bathrooms</th>
            <th>Storeys</th>
            <th>Garages</th>
            <th>Price</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="house in houses" :key="house.id">
            <td>{{ house.name }}</td>
            <td>{{ house.bedrooms }}</td>
            <td>{{ house.bathrooms }}</td>
            <td>{{ house.storeys }}</td>
            <td>{{ house.garages }}</td>
            <td>{{ house.price }}</td>
          </tr>
        </tbody>
      </table>
  
      <!-- Индикатор загрузки -->
      <div v-if="loading" class="text-center mt-4 d-flex justify-content-center align-items-center">
  <div class="spinner-border" role="status">
    <span class="visually-hidden">Loading...</span>
  </div>
</div>


    <!-- Сообщение о пустом результате -->
    <div v-else-if="!loading" class="mt-4">
      <p v-if="houses.length === 0">No houses found.</p>
    </div>
    </div>
  </template>

<script>
export default {
  data() {
    return {
      name: '',
      bedrooms: null,
      bathrooms: null,
      storeys: null,
      garages: null,
      price_from: null,
      price_to: null,
      houses: [],
      loading: false,
      showTable: false, // Флаг для отображения таблицы
    };
  },
  methods: {
    search() {
      this.loading = true;
      this.showTable = false; // Скрываем таблицу перед запросом

      // запрос с задержкой
      setTimeout(() => {
        axios
          .get('/houses/search', {
            params: {
              name: this.name,
              bedrooms: this.bedrooms,
              bathrooms: this.bathrooms,
              storeys: this.storeys,
              garages: this.garages,
              price_from: this.price_from,
              price_to: this.price_to,
            },
          })
          .then((response) => {
            this.houses = response.data;
            this.showTable = true; // Показываем таблицу после получения данных
            this.loading = false;
          })
          .catch((error) => {
            console.error(error);
            this.loading = false;
          });
      }, 2000);
    },
  },
};
</script>

