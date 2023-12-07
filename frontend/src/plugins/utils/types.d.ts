export interface Product {
  id: number;
  name: string;
  description: string;
  quantity: number;
  price: number;
}

export interface ProductResponse extends Product {
  data?: Product;
  status: number;
  message?: string;
}

export interface Movement extends Product {
  id: number;
  product_id: number;
  type: string;
  quantity: number;
  product: Product;
}

export interface MovementResponse extends Movement {
  data?: Movement;
  status: number;
  message?: string;
}
