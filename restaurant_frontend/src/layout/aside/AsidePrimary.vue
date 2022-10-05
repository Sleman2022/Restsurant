<template>
  <div
    class="aside-primary d-flex flex-column align-items-lg-center flex-row-auto"
  >
    <div
      class="
        aside-logo
        d-none d-lg-flex
        flex-column
        align-items-center
        flex-column-auto
        py-10
      "
      id="kt_aside_logo"
    >
      <a href="#">
        <img alt="Logo" src="media/logos/logo-demo7.svg" class="h-30px" />
      </a>
    </div>

    <div
      class="
        aside-nav
        d-flex
        flex-column
        align-items-center
        flex-column-fluid
        w-100
        pt-5 pt-lg-0
      "
      id="kt_aside_nav"
    >
      <div
        class="hover-scroll-y mb-10"
        data-kt-scroll="true"
        data-kt-scroll-activate="{default: false, lg: true}"
        data-kt-scroll-height="auto"
        data-kt-scroll-wrappers="#kt_aside_nav"
        data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer"
        data-kt-scroll-offset="0px"
      >
        <ul class="nav flex-column">
          <li
            class="nav-item mb-2"
            data-bs-toggle="tooltip"
            data-bs-trigger="hover"
            data-bs-placement="right"
            data-bs-dismiss="click"
            title="Users"
            data-bs-original-title="Users"
            v-if="role"
          >
            <router-link
                class="nav-link text-active-primary me-6"
                to="/users"
                active-class="active"
            >
<!--            <a-->
<!--              class="-->
<!--                nav-link-->
<!--                btn-->
<!--                btn-icon-->
<!--                btn-active-color-primary-->
<!--                btn-color-gray-400-->
<!--                btn-active-light-->
<!--              "-->
<!--              data-bs-toggle="tab"-->
<!--              href="#kt_aside_nav_tab_projects"-->
<!--            >-->
              <span class="svg-icon svg-icon-2x">
                <inline-svg src="media/icons/duotune/general/gen049.svg" />
              </span>
<!--            </a>-->
            </router-link>
          </li>

          <li
            class="nav-item mb-2"
            data-bs-toggle="tooltip"
            data-bs-trigger="hover"
            data-bs-placement="right"
            data-bs-dismiss="click"
            title="Menus"
            data-bs-original-title="Menus"
            v-if="role"
          >
            <a
              class="
                nav-link
                btn
                btn-icon
                btn-active-color-primary
                btn-color-gray-400
                btn-active-light
                active
              "
              data-bs-toggle="tab"
              href="#kt_aside_nav_tab_menu"
            >
              <span class="svg-icon svg-icon-2x">
                <inline-svg src="media/icons/duotune/general/gen028.svg" />
              </span>
            </a>
          </li>

          <li
            class="nav-item mb-2"
            data-bs-toggle="tooltip"
            data-bs-trigger="hover"
            data-bs-placement="right"
            data-bs-dismiss="click"
            title="Categories"
            data-bs-original-title="Categories"
            v-if="role"
          >
            <a
              class="
                nav-link
                btn
                btn-icon
                btn-active-color-primary
                btn-color-gray-400
                btn-active-light
              "
              data-bs-toggle="tab"
              href="#kt_aside_nav_tab_subscription"
            >
              <span class="svg-icon svg-icon-2x">
                <inline-svg src="media/icons/duotune/general/gen008.svg" />
              </span>
            </a>
          </li>

          <li
            class="nav-item mb-2"
            data-bs-toggle="tooltip"
            data-bs-trigger="hover"
            data-bs-placement="right"
            data-bs-dismiss="click"
            title="Items"
            data-bs-original-title="Items"
            v-if="role"
          >
            <a
              class="
                nav-link
                btn
                btn-icon
                btn-active-color-primary
                btn-color-gray-400
                btn-active-light
              "
              data-bs-toggle="tab"
              href="#kt_aside_nav_tab_tasks"
            >
              <span class="svg-icon svg-icon-2x">
                <inline-svg src="media/icons/duotune/general/gen005.svg" />
              </span>
            </a>
          </li>
        </ul>
      </div>
    </div>

    <div
      class="
        aside-footer
        d-flex
        flex-column
        align-items-center
        flex-column-auto
      "
      id="kt_aside_footer"
    >
      <div
        class="d-flex align-items-center mb-10"
        id="kt_header_user_menu_toggle"
      >
        <div
          class="cursor-pointer symbol symbol-40px"
          data-kt-menu-trigger="click"
          data-kt-menu-overflow="true"
          data-kt-menu-placement="top-start"
          data-kt-menu-flip="top-end"
          data-bs-toggle="tooltip"
          data-bs-placement="right"
          data-bs-dismiss="click"
          title="User profile"
        >
          <img src="media/avatars/150-26.jpg" alt="metronic" />
        </div>
        <KTUserMenu></KTUserMenu>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import KTUserMenu from "@/layout/header/partials/UserMenu.vue";
import { Actions } from "@/store/enums/StoreEnums";
import {useStore} from "vuex";
export default defineComponent({
  name: "kt-aside-primary",
  components: {
    KTUserMenu,
  },
  data() {
    return {
      role: false,
    }
  },
  mounted() {
    const store = useStore();
    console.log(store.getters.userRole);
    if(store.getters.userRole == 'admin') {
      this.role = true;
    }
  },
});
</script>
