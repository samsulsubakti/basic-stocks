import React from "react";

export const ROUTE_LIST = [
  {
    key: "nav.gen.Base.Users",
    path: "/base/users",
    component: React.lazy(() => import("views/BaseUsers")),
    authority: [],
  },
];
