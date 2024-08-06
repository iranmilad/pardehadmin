// vite.config.js
import { defineConfig } from "file:///F:/xampp/htdocs/pardehadmin/node_modules/vite/dist/node/index.js";
import laravel from "file:///F:/xampp/htdocs/pardehadmin/node_modules/laravel-vite-plugin/dist/index.js";
import preact from "file:///F:/xampp/htdocs/pardehadmin/node_modules/@preact/preset-vite/dist/esm/index.mjs";
var vite_config_default = defineConfig({
  plugins: [
    preact({
      prefreshEnabled: true
    }),
    laravel({
      input: [
        "resources/css/app.css",
        "resources/css/style-rtl.css",
        "resources/plugins/global/plugins.bundle.rtl.css",
        "resources/js/app.js",
        "resources/js/file-manager.js"
      ],
      refresh: true
    })
  ]
});
export {
  vite_config_default as default
};
//# sourceMappingURL=data:application/json;base64,ewogICJ2ZXJzaW9uIjogMywKICAic291cmNlcyI6IFsidml0ZS5jb25maWcuanMiXSwKICAic291cmNlc0NvbnRlbnQiOiBbImNvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9kaXJuYW1lID0gXCJGOlxcXFx4YW1wcFxcXFxodGRvY3NcXFxccGFyZGVoYWRtaW5cIjtjb25zdCBfX3ZpdGVfaW5qZWN0ZWRfb3JpZ2luYWxfZmlsZW5hbWUgPSBcIkY6XFxcXHhhbXBwXFxcXGh0ZG9jc1xcXFxwYXJkZWhhZG1pblxcXFx2aXRlLmNvbmZpZy5qc1wiO2NvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9pbXBvcnRfbWV0YV91cmwgPSBcImZpbGU6Ly8vRjoveGFtcHAvaHRkb2NzL3BhcmRlaGFkbWluL3ZpdGUuY29uZmlnLmpzXCI7aW1wb3J0IHsgZGVmaW5lQ29uZmlnIH0gZnJvbSAndml0ZSc7XG5pbXBvcnQgbGFyYXZlbCBmcm9tICdsYXJhdmVsLXZpdGUtcGx1Z2luJztcbmltcG9ydCBwcmVhY3QgZnJvbSBcIkBwcmVhY3QvcHJlc2V0LXZpdGVcIjtcblxuXG5leHBvcnQgZGVmYXVsdCBkZWZpbmVDb25maWcoe1xuICAgIHBsdWdpbnM6IFtcbiAgICAgICAgcHJlYWN0KHtcbiAgICAgICAgICAgIHByZWZyZXNoRW5hYmxlZDogdHJ1ZSxcbiAgICAgICAgfSksXG4gICAgICAgIGxhcmF2ZWwoe1xuICAgICAgICAgICAgaW5wdXQ6IFtcbiAgICAgICAgICAgICAgICAncmVzb3VyY2VzL2Nzcy9hcHAuY3NzJyxcbiAgICAgICAgICAgICAgICAncmVzb3VyY2VzL2Nzcy9zdHlsZS1ydGwuY3NzJyxcbiAgICAgICAgICAgICAgICAncmVzb3VyY2VzL3BsdWdpbnMvZ2xvYmFsL3BsdWdpbnMuYnVuZGxlLnJ0bC5jc3MnLFxuXG4gICAgICAgICAgICAgICAgJ3Jlc291cmNlcy9qcy9hcHAuanMnLFxuICAgICAgICAgICAgICAgICdyZXNvdXJjZXMvanMvZmlsZS1tYW5hZ2VyLmpzJ1xuICAgICAgICAgICAgXSxcbiAgICAgICAgICAgIHJlZnJlc2g6IHRydWUsXG4gICAgICAgIH0pLFxuICAgIF0sXG59KTtcbiJdLAogICJtYXBwaW5ncyI6ICI7QUFBMlEsU0FBUyxvQkFBb0I7QUFDeFMsT0FBTyxhQUFhO0FBQ3BCLE9BQU8sWUFBWTtBQUduQixJQUFPLHNCQUFRLGFBQWE7QUFBQSxFQUN4QixTQUFTO0FBQUEsSUFDTCxPQUFPO0FBQUEsTUFDSCxpQkFBaUI7QUFBQSxJQUNyQixDQUFDO0FBQUEsSUFDRCxRQUFRO0FBQUEsTUFDSixPQUFPO0FBQUEsUUFDSDtBQUFBLFFBQ0E7QUFBQSxRQUNBO0FBQUEsUUFFQTtBQUFBLFFBQ0E7QUFBQSxNQUNKO0FBQUEsTUFDQSxTQUFTO0FBQUEsSUFDYixDQUFDO0FBQUEsRUFDTDtBQUNKLENBQUM7IiwKICAibmFtZXMiOiBbXQp9Cg==
