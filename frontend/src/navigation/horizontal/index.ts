import type { HorizontalNavItems } from "@layouts/types";

export default [
  {
    title: "List",
    to: { name: "tasks" },
    icon: { icon: "tabler-list-check" },
  },
  {
    title: "Add",
    to: { name: "add" },
    icon: { icon: "tabler-plus" },
  },
] as HorizontalNavItems;
