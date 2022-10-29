module "s3" {
    source = "../../modules/s3"

    env = var.env
    backend_assets_bucket_name = var.backend_assets_bucket_name
}

module "network" {
    source = "../../modules/network"

    name = var.name

    azs = var.azs
}

module "rds" {
    source = "../../modules/rds"

    name = var.name

    vpc_id     = module.network.vpc_id
    subnet_ids = module.network.private_subnet_ids

    database_name   = var.database_name
    database_master_password = var.database_master_username
    database_master_username = var.database_master_password
}
