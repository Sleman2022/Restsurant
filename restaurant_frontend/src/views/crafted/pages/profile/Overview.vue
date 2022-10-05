<template>
  <div class="row g-5 g-xxl-8">

  </div>
</template>

<script lang="ts">
import { defineComponent, onMounted } from "vue";
import { setCurrentPageBreadcrumbs } from "@/core/helpers/breadcrumb";

export default defineComponent({
  name: "overview",
  components: {
  },
  setup() {
    onMounted(() => {
      setCurrentPageBreadcrumbs("Overview", ["Pages", "Profile"]);
    });
  },
});
</script>
