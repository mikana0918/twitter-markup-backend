variable "name" {
    type = string
}

variable "vpc_id" {
    type = string
}

variable "subnet_ids" {
    type = list
}

variable "database_name" {
    type = string
}

variable "database_master_password" {
    type = string
}

variable "database_master_username" {
    type = string
}
