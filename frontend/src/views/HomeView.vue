<template>
  <div class="container">
    <EditDeviceModal :device="selectedDevice"/>
    <NewDeviceModal :device="selectedDevice"/>
    <h1 class="mb-3 mt-3 mb-5 d-flex justify-content-center">Devices</h1>
    <div class="mb-3 mt-3 mb-5 d-flex justify-content-center" >
      <button type="button" :disabled="isLogged()" data-bs-toggle="modal" data-bs-target="#createModal" class="btn btn-success">New Device</button>
    </div>
    <div v-if="devices.length === 0">
      <p class=" d-flex justify-content-center">Devices not exists!</p>
    </div>
    <table v-if="devices.length > 0" class="table table-fluid" id="myTable">
      <thead>
      <tr><th>Name</th><th>IP</th><th></th></tr>
      </thead>
      <tbody>
      <tr v-for="(device, index) in devices" :key="index"><td>{{ device.name }}</td><td>{{ device.ip }}</td>
        <td class="d-flex justify-content-end">
          <button type="button" :disabled="isUserRoleAdmin()" class="btn btn-primary mx-2"  data-bs-toggle="modal" data-bs-target="#editModal" @click="setSelectedDevice(device)">Edit</button>
          <button type="button" :disabled="isUserRoleAdmin()" class="btn btn-danger" @click="deleteDevice(device)">Delete</button>
        </td></tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import fetchUrl from "@/components/Fetch";
import EditDeviceModal from "@/components/EditDeviceModal.vue";
import NewDeviceModal from "@/components/NewDeviceModal.vue";
export default {
  // eslint-disable-next-line no-unused-vars
  async mounted() {
    this.devices = await fetchUrl.get("device/all");
  },
  name: 'HomeView',
  components: {
    fetchUrl,
    EditDeviceModal,
    NewDeviceModal
  },
  data() {
    return {
      devices: [],
      selectedDevice: ''
    };
  },
  methods: {
    setSelectedDevice(device) {
      this.selectedDevice = device;
    },
    isUserRoleAdmin() {
      const userRole = localStorage.getItem('role');
      return userRole !== '1';
    },
    isLogged(){
      const userRole = localStorage.getItem('role');
      return userRole === null;
    },
    async deleteDevice(device){
      await fetchUrl.delete("device/delete", {deviceId:device.id});
      const index = this.devices.indexOf(device);
      if (index !== -1) {
        this.devices.splice(index, 1);
      }
    },
  }
}
</script>
