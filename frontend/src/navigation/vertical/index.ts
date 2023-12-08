import type { VerticalNavItems } from "@/@layouts/types";

export default [
  {
    title: "List",
    to: { name: "index" },
    icon: { icon: "tabler-list-check" },
  },
  {
    title: "Add",
    to: { name: "add" },
    icon: { icon: "tabler-plus" },
  },
] as VerticalNavItems;
