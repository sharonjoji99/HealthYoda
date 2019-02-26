import sys
import pickle
knn_pkl = open('/var/www/html/python/knn.pkl','rb')
knn = pickle.load(knn_pkl)
a=int(sys.argv[1])
b=int(sys.argv[2])
c=int(sys.argv[3])
d=int(sys.argv[4])
e=int(sys.argv[5])
f=int(sys.argv[6])
print(knn.predict([[a,b,c,d,e,f]])[0])