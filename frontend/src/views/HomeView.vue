<template>
  <div class="container">
    <h2 class="mb-3">Devices</h2>
    <div v-if="devices.length === 0">
      <p class=" d-flex justify-content-center">Devices not exist!</p>
    </div>
    <table v-if="devices.length > 0" class="table table-fluid" id="myTable">
      <thead>
      <tr><th>Name</th><th>IP</th><th></th></tr>
      </thead>
      <tbody>
      <tr v-for="(device, index) in devices" :key="index"><td>{{ device.name }}</td><td>{{ device.ip }}</td>
        <td class="d-flex justify-content-end">
          <button type="button" class="btn btn-primary">Edit</button>
          <button type="button" class="btn btn-success">Update</button>
          <button type="button" class="btn btn-danger">Delete</button>
        </td></tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import fetchUrl from "@/components/Fetch";


export default {
  name: 'HomeView',
  components: {
    fetchUrl
  },
  data() {
    return {
      devices: [],
      selectedDevice: ''
    };
  },
  async mounted() {
    this.devices = await fetchUrl.get("http://localhost:8001/api/device/all");
  },
}
</script>
