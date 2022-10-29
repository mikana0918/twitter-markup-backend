resource "aws_s3_bucket" "backend-asset" {
    bucket = var.backend_assets_bucket_name
    tags = {
        Name = "${var.env}-backend-asset"
        Environment = var.env
        Service = "twitter-markup-backend"
    }
}

#パブリックアクセス設定
resource "aws_s3_bucket_public_access_block" "twitter-backend-private" {
    bucket = aws_s3_bucket.backend-asset.id
    block_public_acls = false
    block_public_policy = false
    ignore_public_acls = false
    restrict_public_buckets = false
}

#バージョニング設定
resource "aws_s3_bucket_versioning" "twitter-backend-versionin" {
    bucket = aws_s3_bucket.backend-asset.id
    versioning_configuration {
        status = "Disabled"
    }
}

# サーバー側の暗号化
resource "aws_s3_bucket_server_side_encryption_configuration" "twitter-backend-encryption" {
    bucket = aws_s3_bucket.backend-asset.id
    rule {
        apply_server_side_encryption_by_default {
            sse_algorithm = "AES256"
        }
    }
}

# ACLの設定
//private:デフォルトACL。所有者に FULL_CONTROL が付与される
resource "aws_s3_bucket_acl" "twitter-backend-acl" {
    bucket = aws_s3_bucket.backend-asset.id
    acl = "private"
}
