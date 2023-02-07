<template>
    <div>
        <p>{{ title }}</p>
    </div>

    <!-- Zatiaľ ignorovať -->
    <!-- <div class="position-relative col-md-6">
      <input class="w-100 border-0 rounded-2 py-2 pe-5 ps-3 fs-7" type="text" placeholder="Napíš úlohu...">
      <div class="send-wrapper position-absolute d-flex align-items-center bottom-50">
          <button id="send-button" class="d-flex align-items-center border-0 bg-white">
              <img class="px-2 py-1" src="../assets/logo.png" alt="Odoslať.">
          </button>
      </div>
    </div> -->
</template>

<script>
export default {
    name: "TaskItem",
    props: {
        title: String,
    },
};
</script>

<style>

</style>