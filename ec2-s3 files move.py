import boto3
import os

# Initialize the S3 client
s3 = boto3.client('s3')

# Set the source file path
src_path = 'C:\\xampp\\htdocs\\test\\testfile.txt'

# Set the S3 bucket and destination key
bucket_name = 'bucketname'
dest_key = 'testfile.txt'

# Upload the file to S3
s3.upload_file(src_path, bucket_name, dest_key)

# Check if the file exists in S3
if s3.head_object(Bucket=bucket_name, Key=dest_key):
    print('File uploaded successfully.')
else:
    print('Error: File upload failed.')
