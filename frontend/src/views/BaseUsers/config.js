export const PageConfig = {
  moduleTitle: "Base",
  pageTitle: "users",
  baseEnpoint: "/base/users",
  primaryKey: "id",
  maxBottomIndexDropdown: 2,
  enableSearchTools: true,
  enableExportTools: true,
  enableFilterTools: true,
  enableColumnTools: true,
  enableActions: true,
  enableCreate: true,
  enableDetails: true,
  enableEdit: true,
  enableDelete: true,
  enableBulkDelete: true,
  enablePagination: true,
  enableLimitPerPage: true,
  enableRefreshTable: true,
  listFields: [
    {
      key: "id",
      label: "Id",
      sortable: true,
      width: 90,
      is_show: true,
    },
    {
      key: "created_at",
      label: "Created At",
      sortable: true,
      width: "auto",
      is_show: false,
    },
    {
      key: "updated_at",
      label: "Updated At",
      sortable: true,
      width: "auto",
      is_show: false,
    },
    {
      key: "name",
      label: "Name",
      sortable: true,
      width: "auto",
      is_show: true,
    },
    {
      key: "email",
      label: "Email",
      sortable: true,
      width: "auto",
      is_show: true,
    },
    {
      key: "email_verified_at",
      label: "Email Verified At",
      sortable: true,
      width: "auto",
      is_show: true,
    },
    {
      key: "username",
      label: "Username",
      sortable: true,
      width: "auto",
      is_show: true,
    },
    {
      key: "is_active",
      label: "Is Active",
      sortable: true,
      width: "auto",
      is_show: true,
    },
  ],
  formFilterFields: [
    {
      key: "name",
      label: "Name",
      type: "text",
      rules: [],
    },
    {
      key: "email",
      label: "Email",
      type: "text",
      rules: [],
    },
    {
      key: "email_verified_at",
      label: "Email Verified At",
      type: "text",
      rules: [],
    },
    {
      key: "password",
      label: "Password",
      type: "text",
      rules: [],
    },
    {
      key: "username",
      label: "Username",
      type: "text",
      rules: [],
    },
    {
      key: "is_active",
      label: "Is Active",
      type: "text",
      rules: [],
    },
    {
      key: "remember_token",
      label: "Remember Token",
      type: "text",
      rules: [],
    },
  ],
  formFields: [
    {
      key: "name",
      label: "Name",
      type: "text",
      rules: ["required"],
    },
    {
      key: "email",
      label: "Email",
      type: "text",
      rules: ["required"],
    },
    {
      key: "email_verified_at",
      label: "Email Verified At",
      type: "text",
      rules: ["required"],
    },
    {
      key: "password",
      label: "Password",
      type: "text",
      rules: ["required"],
    },
    {
      key: "username",
      label: "Username",
      type: "text",
      rules: ["required"],
    },
    {
      key: "is_active",
      label: "Is Active",
      type: "text",
      rules: ["required"],
    },
    {
      key: "remember_token",
      label: "Remember Token",
      type: "text",
      rules: ["required"],
    },
  ],
};
