module "s3" {
    source = "../../modules/s3"

    env = var.env
    backend_assets_bucket_name = var.backend_assets_bucket_name
}
