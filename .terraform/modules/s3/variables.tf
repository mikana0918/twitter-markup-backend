variable "env" {
    description = "Environment name."
    type = string
}

variable "backend_assets_bucket_name" {
    description = "Name for backend assets bucket."
    type = string
}

variable "ver_enabled" {
    description = "Toggle for enabling versioning."
    type = bool
    default = false
}
