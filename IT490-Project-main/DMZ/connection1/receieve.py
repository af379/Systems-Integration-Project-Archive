# consumer.py
# Consume RabbitMQ queue

import pika
connection = pika.BlockingConnection(pika.ConnectionParameters('192.168.191.76', 5672, 'IT490', pika.PlainCredentials("Mohammad", "april282000")))
channel = connection.channel()

def callback(ch, method, properties, body):
    print(f'{body} is received')
    
channel.basic_consume(queue="Queue-Test", on_message_callback=callback, auto_ack=True)
channel.start_consuming()