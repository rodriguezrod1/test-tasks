import type { VerticalNavItems } from "@/@layouts/types";

export default [
  {
    title: "Compras",
    to: { name: "index" },
    icon: { icon: "tabler-smart-home" },
  },
  {
    title: "Ventas",
    to: { name: "sales" },
    icon: { icon: "tabler-shopping-cart" },
  },
  {
    title: "Movimientos",
    to: { name: "movements" },
    icon: { icon: "tabler-list-check" },
  },
  {
    title: "Stock",
    to: { name: "stock" },
    icon: { icon: "tabler-list" },
  },
] as VerticalNavItems;
