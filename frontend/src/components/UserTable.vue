<script>

const API = {
  async fetch (page, itemsPerPage, sortBy) {
    return new Promise(async resolve => {

        const url = `http://localhost?page=${page}&perPage=${itemsPerPage}`;
        let response =  await (await fetch(url)).json();

        resolve({ items: response.data, total: response.meta.total });
    })
  },
}

export default {
  data: () => ({
    itemsPerPage: 5,
    headers: [
      { title: 'Name', key: 'name', align: 'start' },
      { title: 'Temp', key: 'weather.temp', align: 'start' },
      { title: 'Action', key: '', align: 'start' }
    ],
    serverItems: [],
    loading: true,
    totalItems: 0,
  }),
  beforeMount () {
    this.loadItems({ page: 1, itemsPerPage: 5, sortBy: [] })
  },
  methods: {
    async loadItems ({ page, itemsPerPage, sortBy }) {
      this.loading = true
      API.fetch(page, itemsPerPage, sortBy).then(({items, total}) => {
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
        <td></td>
      </tr>
    </template>
  </v-data-table-server>
</template>