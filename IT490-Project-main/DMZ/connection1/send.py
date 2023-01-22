#!/usr/bin/env python
import pika

credentials = pika.PlainCredentials('Mohammad', 'april282000')
parameters = pika.ConnectionParameters('192.168.191.76',
                                   5672,
                                   'IT490',
                                   credentials)

connection = pika.BlockingConnection(parameters)

channel = connection.channel()

channel.queue_declare(queue='hello')

channel.basic_publish(exchange='DmzFanout',
                  routing_key='DmzFanDB',
                  body='Hello W0rld!')
print(" [x] Sent 'Hello World!'")
connection.close()
