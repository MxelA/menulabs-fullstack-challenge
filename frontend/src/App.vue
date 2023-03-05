<script setup lang="ts">
import { RouterLink, RouterView } from "vue-router";
</script>

<template>
  <v-card>
    <v-layout>
      <v-navigation-drawer
          expand-on-hover
          rail
      >
        <v-list>
          <v-list-item
              prepend-avatar="https://randomuser.me/api/portraits/women/85.jpg"
              title="Sandra Adams"
              subtitle="sandra_a88@gmailcom"
          ></v-list-item>
        </v-list>

        <v-divider></v-divider>

        <v-list density="compact" nav>
          <v-list-item prepend-icon="mdi-account-multiple" title="Users" value="users">
            <RouterLink to="/"></RouterLink>
          </v-list-item>
        </v-list>
      </v-navigation-drawer>

      <v-main style="height: 250px">
        <RouterView />
      </v-main>
    </v-layout>
  </v-card>
</template>

<style scoped>

</style>
