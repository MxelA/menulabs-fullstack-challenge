<script>

const API = {
  async fetchUsers (page, itemsPerPage, sortBy) {
    return new Promise(async resolve => {

        const url = `http://localhost/user?page=${page}&perPage=${itemsPerPage}`;
        let response =  await (await fetch(url)).json();

        resolve({ items: response.data, total: response.meta.total });
    })
  },

  async fetchUser (userId) {
    return new Promise(async resolve => {

      const url = `http://localhost/user/${userId}`;
      let response =  await (await fetch(url)).json();

      resolve(response.data);
    })
  },

}

export default {
  data: () => ({
    dialog:false,
    dialogLoading:false,
    itemsPerPage: 5,
    headers: [
      { title: 'Name', key: 'name', align: 'start' },
      { title: 'Temp', key: 'weather.temp', align: 'start' },
      { title: 'Action', key: '', align: 'start' }
    ],
    serverItems: [],
    serverUser:{weather:{}},
    loading: true,
    totalItems: 0,
  }),
  beforeMount () {
    this.loadItems({ page: 1, itemsPerPage: 5, sortBy: [] })
  },
  methods: {
    openDialog(userId) {
      this.dialog = true;
      this.dialogLoading = true;
      API.fetchUser(userId).then((user) => {
        this.serverUser = user;
        this.dialogLoading = false;
      })
    },
    async loadItems ({ page, itemsPerPage, sortBy }) {
      this.loading = true
      API.fetchUsers(page, itemsPerPage, sortBy).then(({items, total}) => {
        this.serverItems = items
        this.totalItems = total
        this.loading = false
      })
    },
  },
}
</script>

<template>
  <v-data-table-server
      v-model:items-per-page="itemsPerPage"
      :headers="headers"
      :items-length="totalItems"
      :items="serverItems"
      :loading="loading"
      class="elevation-1"
      item-title="name"
      item-value="name"
      @update:options="loadItems"
  >
    <template v-slot:item="{ item }">
      <tr>
        <td>{{ item.columns.name }}</td>
        <td>{{ item.columns['weather.temp'] }}<span v-html="item.raw.weather.temp_unit_html_code"></span></td>
        <td><v-icon icon="mdi-eye" @click="openDialog(item.raw.id)"></v-icon></td>
      </tr>
    </template>
  </v-data-table-server>

  <v-dialog
      v-model="dialog"
      width="auto"
      min-width="500"
  >
    <v-card>
<!--      <v-toolbar-->
<!--          color="blue"-->
<!--          title="Weather info"-->
<!--      ></v-toolbar>-->
<!--      <v-divider></v-divider>-->
      <v-card-text color="blue" v-show="dialogLoading">
        <v-progress-linear
            indeterminate
            color="blue"
            class="mb-0"
        ></v-progress-linear>
      </v-card-text>
      <v-card-title v-show="!dialogLoading">
        Weather info
        <v-divider></v-divider>
      </v-card-title>
      <v-card-subtitle v-show="!dialogLoading">
        User: {{ serverUser.name}}
      </v-card-subtitle>
      <v-card-subtitle v-show="!dialogLoading">
        Location: {{ serverUser.latitude}}, {{ serverUser.longitude}}
      </v-card-subtitle>
      <v-card-text v-show="!dialogLoading">
        <v-table>
          <tbody>
          <tr>
            <td>Temp</td>
            <td>{{ serverUser.weather.temp }} <span v-html="serverUser.weather.temp_unit_html_code"></span></td>
          </tr>
          <tr>
            <td>Pressure</td>
            <td>{{ serverUser.weather.pressure }} <span>Pa</span></td>
          </tr>
          <tr>
            <td>Humidity</td>
            <td>{{ serverUser.weather.humidity }} <span>%</span></td>
          </tr>
          </tbody>
        </v-table>
      </v-card-text>
      <v-card-actions>
        <v-btn color="blue" block @click="dialog = false">Close</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>